<?php

namespace Paysera\Bundle\PhpGeneratorBundle;

use Paysera\Component\DependencyInjection\AddTaggedCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PayseraPhpGeneratorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_php_generator.code_generator.php_client',
            'paysera_php_generator.php_client',
            'addGenerator',
            ['position']
        ));

        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_php_generator.code_generator.symfony_bundle',
            'paysera_php_generator.symfony_bundle',
            'addGenerator',
            ['position']
        ));
    }
}
