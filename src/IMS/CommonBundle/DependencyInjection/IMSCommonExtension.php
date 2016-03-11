<?php
/**
 * Symfony DI extension to load services
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-common
 * @category Dependency Injection
 * @since 2015.05.08
 */

namespace IMS\CommonBundle\DependencyInjection;

use Gedmo\Exception\InvalidMappingException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class IMSCommonExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $container->setParameter('ims_common.translation_fallback', $config['translation_fallback']);
        $container->setParameter('ims_common.persist_default_translation', $config['persist_default_translation']);
        $container->setParameter('ims_common.skip_translation_on_load', $config['skip_translation_on_load']);

        $bundles = $container->getParameter('kernel.bundles');

        $rawMetadata = array();
        foreach ($config['mapping'] as $bundleName) {
            if (isset($bundles[$bundleName])) {
                $reflection = new \ReflectionClass($bundles[$bundleName]);
                if (is_file($file = dirname($reflection->getFilename()) . '/Resources/config/metadata.yml')) {
                    $rawMetadata[] = Yaml::parse(file_get_contents(realpath($file)));
                }
            } else {
                throw new InvalidMappingException("Bundle '$bundles[$bundleName]' does not exist.");
            }
        }

        $metadata = array();
        foreach ($rawMetadata as $bundle) {
            foreach ($bundle as $className => $classMetadata) {

                if (isset($metadata[$className])) {
                    $metadata[$className] = array_merge($metadata[$className], $classMetadata);
                } else {
                    $metadata[$className] = $classMetadata;
                }
            }
        }

        $container->setParameter('ims_common.metadata', $metadata);
    }

}