<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('maltehuebner_impressbundle');

        $treeBuilder->getRootNode()
            ->children()
            ->enumNode('source')
            ->values(['default_values', 'remote_json', 'remote_vcard'])
            ->isRequired()
            ->end()
            ->arrayNode('defaults')
            ->children()
            ->scalarNode('first_name')->end()
            ->scalarNode('last_name')->end()
            ->scalarNode('street')->end()
            ->scalarNode('house_number')->end()
            ->scalarNode('zip_code')->end()
            ->scalarNode('city')->end()
            ->scalarNode('country')->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
