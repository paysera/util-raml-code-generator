<?php

namespace Paysera\Bundle\PharBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('paysera_phar');

        $rootNode
            ->children()
                ->scalarNode('package_name')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('phar_name')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('current_version')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
