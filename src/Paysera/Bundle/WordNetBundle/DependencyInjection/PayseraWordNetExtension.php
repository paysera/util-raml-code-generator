<?php

namespace Paysera\Bundle\WordNetBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PayseraWordNetExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $sqliteFile = $config['sqlite_file'];
        if ($container->getParameter('kernel.environment') === 'phar') {
            $sqliteFile = $this->copySqliteDb($sqliteFile);
        }
        $container->setParameter('paysera_word_net.sqlite_file', $sqliteFile);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * @param string $sqliteFile
     * @return string
     */
    private function copySqliteDb($sqliteFile)
    {
        $tmpDir = sys_get_temp_dir();
        $targetFile = $tmpDir . '/' . basename($sqliteFile);

        if (!file_exists($targetFile)) {
            copy($sqliteFile, $targetFile);
        }

        return $targetFile;
    }
}
