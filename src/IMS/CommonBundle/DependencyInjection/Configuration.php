<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-common
 * @category 
 * @since 2015.05.26
 */

namespace IMS\CommonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ims_common');

        $rootNode
            ->children()
                ->arrayNode('mapping')
                    ->prototype('scalar')->end()
                    ->defaultValue([])
                ->end()
                ->booleanNode('translation_fallback')->defaultFalse()->end()
                ->booleanNode('persist_default_translation')->defaultFalse()->end()
                ->booleanNode('skip_translation_on_load')->defaultFalse()->end()
            ->end()
        ;

        return $treeBuilder;
    }

}