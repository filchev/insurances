<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('document_tools_content_parser');

        $rootNode
            ->children()
                ->arrayNode('sftp')
                    ->children()
                        ->scalarNode('host_ip')->end()
                        ->integerNode('host_port')->end()
                        ->scalarNode('username')->end()
                        ->scalarNode('password')->end()               
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
