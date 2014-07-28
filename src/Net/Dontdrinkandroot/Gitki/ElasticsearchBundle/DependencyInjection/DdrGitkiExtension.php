<?php

namespace Net\Dontdrinkandroot\Gitki\ElasticsearchBundle\DependencyInjection;

use Net\Dontdrinkandroot\Gitki\BaseBundle\DependencyInjection\DdrGitkiExtension as BaseExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

class DdrGitkiExtension extends BaseExtension
{

    public function prepend(ContainerBuilder $container)
    {
        parent::prepend($container);
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $this->doLoad($config, $container);
    }

    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration();
    }

    protected function doLoad($config, ContainerBuilder $container)
    {
        parent::doLoad($config, $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('ddr_gitki_elasticsearch.host', $config['elasticsearch']['host']);
        $container->setParameter('ddr_gitki_elasticsearch.port', $config['elasticsearch']['port']);
    }
}
