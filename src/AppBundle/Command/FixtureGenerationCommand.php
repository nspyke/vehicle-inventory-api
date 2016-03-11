<?php

namespace AppBundle\Command;

use AppBundle\Generator\DoctrineFixtureGenerator;
use IMS\CommonBundle\IMSCommonBundle;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\Yaml\Yaml;

class FixtureGenerationCommand extends GenerateDoctrineCommand
{
    private $config;

    protected function configure()
    {
        $this
            ->setName('generate:doctrine:fixtures')
            ->setDescription('Generate fixtures for the provided bundle')
            ->addOption('count', 'c', InputOption::VALUE_REQUIRED, 'Number of fixtures per entity', 30)
            ->addArgument('source-bundle', InputArgument::REQUIRED, 'Bundle to generate fixtures for')
            ->addArgument('target-bundle', InputArgument::OPTIONAL, 'Bundle create the fixtures in', 'AppBundle')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var IMSCommonBundle $sourceBundle */
        $sourceBundle = $this->getContainer()->get('kernel')->getBundle($input->getArgument('source-bundle'));
        $targetBundle = $this->getContainer()->get('kernel')->getBundle($input->getArgument('target-bundle'));

        $configPath = $targetBundle->getPath().'/Resources/config/fixture-generation.yml';

        if (file_exists($configPath)) {
            $this->config = Yaml::parse(file_get_contents($configPath));
        }

        $exclude = [];

        if (isset($this->config['exclude'])) {
            $exclude = $this->config['exclude'];
        }

        $finder = new Finder();
        $files = $finder
            ->files()
            ->filter(function(\SplFileInfo $file) use ($exclude) {
                if (in_array($file->getBasename('.php'), $exclude)) {
                    return false;
                }
            })
            ->in($sourceBundle->getPath().'/Entity')
        ;

        /** @var DoctrineFixtureGenerator $generator */
        $generator = $this->getGenerator($targetBundle);

        $data = null;
        if (isset($this->config['data'])) {
            $data = $this->config['data'];

            // pre-process data config
            foreach ($data as $clName => $conf) {
                if (array_key_exists('count', $conf)) {
                    $targetEntity = $sourceBundle->getNamespace().'\Entity\\'.$clName;
                    $generator->setAlternateCount($generator->convertToReference($targetEntity), $conf['count']);
                }
            }
        }

        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            $className = str_replace('.php', '', $file->getFilename());
            $n = str_replace($sourceBundle->getPath(), '', $file->getRealPath());
            $n = $sourceBundle->getNamespace().str_replace('/', '\\', $n);
            $entity = str_replace('.php', '', $n);

            $ref = new \ReflectionClass($entity);

            if ($ref->isInterface() or $ref->isAbstract()) {
                continue;
            }

            try {
                $metadata = $this->getEntityMetadata($entity);
            } catch (\Doctrine\ORM\Mapping\MappingException $e) {
                $output->writeln(sprintf('<error>Skipping due to mapping exception: %s</error>', $e->getMessage()));
                continue;
            }

            $count = $input->getOption('count');
            $preDefinedData = [];
            if ($data and array_key_exists($className, $data)) {
                if (array_key_exists('values', $data[$className])) {
                    $preDefinedData = $data[$className]['values'];
                }

                if (array_key_exists('count', $data[$className])) {
                    $count = $data[$className]['count'];
                }
            }

            $order = $this->getOrder($className);

            $generator->generate($targetBundle, $entity, $metadata[0], $order, $count, $preDefinedData);
            $output->writeln(sprintf("Generated <info>%s</info> with the order of <info>%d</info>", $entity, $order));
        }
    }

    protected function createGenerator()
    {
        return new DoctrineFixtureGenerator();
    }

    private function getOrder($className)
    {
        if ($this->config === null or !isset($this->config['order'])) {
            return null;
        }

        return array_search($className, $this->config['order']);
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs[] = realpath(__DIR__.'/../Resources/skeleton');
        $skeletonDirs[] = realpath( __DIR__.'/../Resources');

        return $skeletonDirs;
    }


}