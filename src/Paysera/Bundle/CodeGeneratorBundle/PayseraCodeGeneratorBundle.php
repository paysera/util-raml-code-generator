<?php

namespace Paysera\Bundle\CodeGeneratorBundle;

use Paysera\Component\DependencyInjection\AddTaggedCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PayseraCodeGeneratorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_code_generator.code_generator',
            'paysera_code_generator',
            'addLanguageCodeGenerator',
            ['language']
        ));
    }
}
