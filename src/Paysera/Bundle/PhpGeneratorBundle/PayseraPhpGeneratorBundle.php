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
            'paysera_php_generator.language_code_generator',
            'paysera_php_generator',
            'addGenerator',
            ['position']
        ));
    }
}
