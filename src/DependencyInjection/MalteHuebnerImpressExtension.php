<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DependencyInjection;

use MalteHuebner\ImpressBundle\ImpressFactory\ConfigurationImpressFactory;
use MalteHuebner\ImpressBundle\ImpressFactory\RemoteJsonFactory;
use MalteHuebner\ImpressBundle\ImpressManager\ImpressManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

class MalteHuebnerImpressExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $xmlLoader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $xmlLoader->load('services.xml');

        if (!empty($config['source'])) {
            $factory = null;

            switch ($config['source']) {
                case 'default_values': $factory = $container->getDefinition(ConfigurationImpressFactory::class); break;
                case 'remote_json': $factory = $container->getDefinition(RemoteJsonFactory::class); break;
                //case 'remote_vcard': $factory = ConfigurationImpressFactory::class; break;
            }

            $container
                ->getDefinition(ImpressManager::class)
                ->addMethodCall('setFactory', [$factory]);
        }

        if (!empty($config['defaults'])) {
            $container
                ->getDefinition(ConfigurationImpressFactory::class)
                ->addMethodCall('setDefaultValues', [$config['defaults']]);
        }

        if (!empty($config['remote'])) {
            $container
                ->getDefinition(RemoteJsonFactory::class)
                ->addMethodCall('setRemoteUrl', [$config['remote']['url']]);
        }

        /*$container->loadFromExtension('twig', [
            'paths' => [
                '%kernel.project_dir%/vendor/maltehuebner/impress-bundle/Ressources/views' => 'MalteHuebnerImpress',
            ],
        ]);*/
    }
}
