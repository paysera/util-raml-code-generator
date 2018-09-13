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
            'addCodeGenerator',
            ['type']
        ));

        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_code_generator.type_definition_builder',
            'paysera_code_generator.type_definition_builder',
            'addTypeDefinitionBuilder',
            ['position']
        ));

        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_code_generator.type_configuration_provider_storage',
            'paysera_code_generator.type_configuration_provider',
            'addTypeConfigurationProvider',
            ['type']
        ));

        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_code_generator.string_converter',
            'paysera_bundle_code_generator.service.reserved_keyword_detector',
            'addReservedKeywordDetector'
        ));
    }
}
