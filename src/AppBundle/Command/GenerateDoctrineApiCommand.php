<?php

namespace AppBundle\Command;

use AppBundle\Generator\DoctrineApiGenerator;
use AppBundle\Generator\DoctrineFormGenerator;
use AppBundle\Manipulator\ServiceManipulator;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCommand;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Sensio\Bundle\GeneratorBundle\Command\AutoComplete\EntitiesAutoCompleter;
use Sensio\Bundle\GeneratorBundle\Command\Helper\QuestionHelper;
use AppBundle\Manipulator\RoutingManipulator;

/**
 * Generates a API for a Doctrine entity.
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 */
class GenerateDoctrineApiCommand extends GenerateDoctrineCommand
{
    private $formGenerator;

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setDefinition(array(
                new InputArgument('entity', InputArgument::OPTIONAL, 'The entity class name to initialize (shortcut notation)'),
                new InputArgument('target-bundle', InputArgument::OPTIONAL, 'The target bundle the of the generated code'),
                new InputOption('entity', '', InputOption::VALUE_REQUIRED, 'The entity class name to initialize (shortcut notation)'),
                new InputOption('target-bundle', '', InputOption::VALUE_REQUIRED, 'The target bundle the of the generated code'),
                new InputOption('route-prefix', '', InputOption::VALUE_REQUIRED, 'The route prefix'),
                new InputOption('name', '', InputOption::VALUE_REQUIRED, 'Your name'),
                new InputOption('email', '', InputOption::VALUE_REQUIRED, 'Your email'),
                new InputOption('with-write', '', InputOption::VALUE_NONE, 'Whether or not to generate create and update actions'),
                new InputOption('with-delete', '', InputOption::VALUE_NONE, 'Whether or not to generate delete actions'),
                new InputOption('overwrite', '', InputOption::VALUE_NONE, 'Do not stop the generation if crud controller already exist, thus overwriting all generated files'),
            ))
            ->setDescription('Generates a API based on a Doctrine entity')
            ->setHelp(<<<EOT
The <info>doctrine:generate:api</info> command generates a API endpoint based on a Doctrine entity.

The default command only generates the list and getOne actions.

<info>php app/console doctrine:generate:api --entity=AcmeBlogBundle:Post --route-prefix=post_admin</info>

Using the --with-write option allows to generate the create, edit and delete actions.

<info>php app/console doctrine:generate:api --entity=AcmeBlogBundle:Post --route-prefix=post_admin --with-write</info>
EOT
            )
            ->setName('doctrine:generate:api')
            ->setAliases(array('generate:doctrine:api'))
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getQuestionHelper();

        if ($input->isInteractive()) {
            $question = new ConfirmationQuestion($questionHelper->getQuestion('Do you confirm generation', 'yes', '?'), true);
            if (!$questionHelper->ask($input, $output, $question)) {
                $output->writeln('<error>Command aborted</error>');

                return 1;
            }
        }

        $entityClassName = Validators::validateEntityName($input->getOption('entity'));
        list($entityBundle, $entityClassName) = $this->parseShortcutNotation($entityClassName);

        $format = 'yml';
        $prefix = $this->getRoutePrefix($input, $entityClassName);
        $withWrite = $input->getOption('with-write');
        $withDelete = $input->getOption('with-delete');
        $forceOverwrite = $input->getOption('overwrite');
        $name = $input->getOption('name');
        $email = $input->getOption('email');
        $targetBundle = $input->getOption('target-bundle');

        $questionHelper->writeSection($output, 'API generation');

        $entityFQCN = $this->getContainer()->get('doctrine')->getAliasNamespace($entityBundle).'\\'.$entityClassName;
        $metadata    = $this->getEntityMetadata($entityFQCN);
        $bundle      = $this->getContainer()->get('kernel')->getBundle($targetBundle);

        $generator = $this->getGenerator($bundle);
        $generator->generate(
            $bundle,
            $entityFQCN,
            $metadata[0],
            $format,
            $prefix,
            $withWrite,
            $withDelete,
            $forceOverwrite,
            $name,
            $email
        );

        $output->writeln('Generating the API code: <info>OK</info>');

        $errors = array();
        $runner = $questionHelper->getRunner($output, $errors);

        // form
        if ($withWrite) {
            $output->write('Generating the Form code: ');
            if ($this->generateForm($bundle, $entityFQCN, $metadata, $name, $email)) {
                $output->writeln('<info>OK</info>');
            } else {
                $output->writeln('<comment>Already exists, skipping</comment>');
            }
        }

        // routing
        if ('annotation' != $format) {
            $runner($this->updateRouting($questionHelper, $input, $output, $bundle, $format, $entityClassName, $prefix));
            $runner($this->updateServices($questionHelper, $input, $output, $bundle, $entityFQCN, $prefix, $withWrite));
        }

        $questionHelper->writeGeneratorSummary($output, $errors);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getQuestionHelper();
        $questionHelper->writeSection($output, 'Welcome to the Doctrine2 API generator');

        // namespace
        $output->writeln(array(
            '',
            'This command helps you generate API controllers and templates.',
            '',
            'First, you need to give the entity for which you want to generate a API Endpoint.',
            'You can give an entity that does not exist yet and the wizard will help',
            'you defining it.',
            '',
            'You must use the shortcut notation like <comment>AcmeBlogBundle:Post</comment>.',
            '',
        ));

        if ($input->hasArgument('entity') && $input->getArgument('entity') != '') {
            $input->setOption('entity', $input->getArgument('entity'));
        }

        $question = new Question($questionHelper->getQuestion('The Entity shortcut name', $input->getOption('entity')), $input->getOption('entity'));
        $question->setValidator(array('Sensio\Bundle\GeneratorBundle\Command\Validators', 'validateEntityName'));

        $autocompleter = new EntitiesAutoCompleter($this->getContainer()->get('doctrine')->getManager());
        $autocompleteEntities = $autocompleter->getSuggestions();
        $question->setAutocompleterValues($autocompleteEntities);
        $entity = $questionHelper->ask($input, $output, $question);

        $input->setOption('entity', $entity);
        list($bundle, $entity) = $this->parseShortcutNotation($entity);

        // target bundle
        if ($input->hasArgument('target-bundle') && $input->getArgument('target-bundle') != '') {
            $input->setOption('target-bundle', $input->getArgument('target-bundle'));
            $bundle = $input->getArgument('target-bundle');
        } else {
            $bundle = 'ApiBundle';
        }

        $question = new Question($questionHelper->getQuestion('The target bundle name', $bundle), $bundle);
        $question->setValidator(array('Sensio\Bundle\GeneratorBundle\Command\Validators', 'validateBundleName'));
        $bundle = $questionHelper->ask($input, $output, $question);
        $input->setOption('target-bundle', $bundle);

        // write?
        $withWrite = $input->getOption('with-write') ?: false;
        $output->writeln(array(
            '',
            'By default, the generator creates two actions: list and show.',
            'You can also ask it to generate "write" and "delete" actions: POST, PUT, PATCH and DELETE.',
            '',
        ));
        $question = new ConfirmationQuestion($questionHelper->getQuestion('Do you want to generate the "write" actions', $withWrite ? 'yes' : 'no', '?', $withWrite), $withWrite);

        $withWrite = $questionHelper->ask($input, $output, $question);
        $input->setOption('with-write', $withWrite);

        // delete ?
        $withDelete = $input->getOption('with-delete') ?: false;
        $question = new ConfirmationQuestion($questionHelper->getQuestion('Do you want to generate the "delete" actions', $withDelete ? 'yes' : 'no', '?', $withDelete), $withDelete);
        $withDelete = $questionHelper->ask($input, $output, $question);
        $input->setOption('with-delete', $withDelete);


        // format
        $format = 'yml';

        // route prefix
        $prefix = $this->getRoutePrefix($input, $entity);
        $output->writeln(array(
            '',
            'Determine the routes prefix (all the routes will be "mounted" under this',
            'prefix: /prefix/, /prefix/new, ...).',
            '',
        ));
        $prefix = $questionHelper->ask($input, $output, new Question($questionHelper->getQuestion('Routes prefix', '/'.$prefix), '/'.$prefix));
        $input->setOption('route-prefix', $prefix);

        // name & email for doc blocks
        $output->writeln(array(
            '',
            'Generated classes requires a doc block with your name and email',
            '',
        ));
        $usersName = $questionHelper->ask($input, $output, new Question($questionHelper->getQuestion('What is your name', 'John Doe', '?'), 'John Doe'));
        $input->setOption('name', $usersName);
        $usersEmail = $questionHelper->ask($input, $output, new Question($questionHelper->getQuestion('What is your
        email', 'dev@example.com', '?'), 'dev@example.com'));
        $input->setOption('email', $usersEmail);

        // summary
        $output->writeln(array(
            '',
            $this->getHelper('formatter')->formatBlock('Summary before generation', 'bg=blue;fg=white', true),
            '',
            sprintf("You are going to generate a API controller for \"<info>%s:%s</info>\"", $bundle, $entity),
            sprintf("using the \"<info>%s</info>\" format.", $format),
            '',
        ));
    }

    /**
     * Tries to generate forms if they don't exist yet and if we need write operations on entities.
     */
    protected function generateForm($bundle, $entity, $metadata, $usersName, $usersEmail)
    {
        try {
            $this->getFormGenerator($bundle)->generate($bundle, $entity, $metadata[0], $usersName, $usersEmail);
        } catch (\RuntimeException $e) {
            return false;
        }

        return true;
    }

    protected function updateRouting(QuestionHelper $questionHelper, InputInterface $input, OutputInterface $output, BundleInterface $bundle, $format, $entity, $prefix)
    {
        $auto = true;
        if ($input->isInteractive()) {
            $question = new ConfirmationQuestion($questionHelper->getQuestion('Confirm automatic update of the Routing', 'yes', '?'), true);
            $auto = $questionHelper->ask($input, $output, $question);
        }

        $parts = explode('\\', $entity);
        $entityClass = array_pop($parts);
        $entityNamespace = implode('\\', $parts);

        $output->write('Importing the API routes: ');
        $this->getContainer()->get('filesystem')->mkdir($bundle->getPath().'/Resources/config/');
        $routing = new RoutingManipulator($bundle->getPath().'/Resources/config/routing.yml');
        try {
            $ret = $auto ? $routing->addResource($bundle->getName(), $format, '/'.$prefix, 'routing/'.strtolower($entityClass)) : false;
        } catch (\RuntimeException $exc) {
            $ret = false;
        }

        if (!$ret) {
            $help = sprintf("        <comment>resource: \"@%s/Resources/config/routing/%s.%s\"</comment>\n", $bundle->getName(), strtolower(str_replace('\\', '_', $entity)), $format);

            return array(
                '- Import the bundle\'s routing resource in the bundle routing file',
                sprintf('  (%s).', $bundle->getPath().'/Resources/config/routing.yml'),
                '',
                sprintf('    <comment>%s:</comment>', strtolower(Container::underscore(substr($bundle->getName(), 0, -6))).('' !== $prefix ? '_'.str_replace('/', '_', $prefix) : '')),
                $help,
                '',
            );
        }
    }

    protected function updateServices(QuestionHelper $questionHelper, InputInterface $input, OutputInterface $output, BundleInterface $bundle, $entityFQCN, $prefix, $withWrite)
    {
        $parts = explode('\\', $entityFQCN);
        $entityClass = array_pop($parts);

        $auto = true;
        if ($input->isInteractive()) {
            $question = new ConfirmationQuestion($questionHelper->getQuestion('Confirm automatic update of the Service container', 'yes', '?'), true);
            $auto = $questionHelper->ask($input, $output, $question);
        }

        $output->write('Adding the handler to the service container: ');
        $this->getContainer()->get('filesystem')->mkdir($bundle->getPath().'/Resources/config/');
        $service = new ServiceManipulator($bundle->getPath().'/Resources/config/services.yml');

        $id = Container::underscore(substr($bundle->getName(), 0, -6)).'.'.Container::underscore(strtolower($entityClass)).'_handler';
        $serviceClass = $bundle->getNamespace().'\\Handler\\'.$entityClass.'Handler';
        $definition = new Definition();
        $definition->setClass($serviceClass);
        $definition->addArgument('@doctrine.orm.default_entity_manager');
        $definition->addArgument($entityFQCN);
        $definition->setTags([['name' => 'knp_paginator.injectable']]);

        if ($withWrite) {
            $definition->addMethodCall('setFormFactory', ['@form.factory']);
        }

        try {
            $ret = $auto ? $service->addService($id, $bundle, $definition) : false;
        } catch (\RuntimeException $exc) {
            $ret = false;
        }

        if (!$ret) {
            $help  = sprintf("    %s:\n", $id);
            $help .= sprintf("        class: %s\n", $serviceClass);
            $help .= "            arguments:\n";
            $help .= "                - @doctrine.orm.default_entity_manager\n";
            $help .= sprintf("                - \"%s\"\n", $entityFQCN);
            if ($withWrite) {
                $help .= "            calls:\n";
                $help .= "                - [setFormFactory, ['@form.factory']]\n";
            }
            $help .= "            tags:\n";
            $help .= "                - { name: knp_paginator.injectable }\n";

            return array(
                '- Import the bundle\'s service resource in the bundle service file',
                sprintf('  (%s).', $bundle->getPath().'/Resources/config/services.yml'),
                '',
                sprintf('    <comment>%s:</comment>', $bundle->getName().('' !== $prefix ? '_'.str_replace('/', '_', $prefix) : '')),
                $help,
                '',
            );
        }
    }

    protected function getRoutePrefix(InputInterface $input, $entity)
    {
        $prefix = $input->getOption('route-prefix') ?: strtolower(str_replace(array('\\', '/'), '_', $entity)).'s';

        if ($prefix && '/' === $prefix[0]) {
            $prefix = substr($prefix, 1);
        }

        return $prefix;
    }

    protected function createGenerator($bundle = null)
    {
        return new DoctrineApiGenerator($this->getContainer()->get('filesystem'));
    }

    protected function getFormGenerator($bundle = null)
    {
        if (null === $this->formGenerator) {
            $this->formGenerator = new DoctrineFormGenerator($this->getContainer()->get('filesystem'));
            $this->formGenerator->setSkeletonDirs($this->getSkeletonDirs($bundle));
        }

        return $this->formGenerator;
    }

    public function setFormGenerator(DoctrineFormGenerator $formGenerator)
    {
        $this->formGenerator = $formGenerator;
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }
}
