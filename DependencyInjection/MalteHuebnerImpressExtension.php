<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DependencyInjection;

use MalteHuebner\ImpressBundle\ImpressFactory\ConfigurationImpressFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class MalteHuebnerImpressExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $xmlLoader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $xmlLoader->load('services.xml');

        if (!empty($config['defaults'])) {
            $container->getDefinition(ConfigurationImpressFactory::class)
                ->addMethodCall('setDefaultValues', [$config['defaults']]);
        }
    }
}
