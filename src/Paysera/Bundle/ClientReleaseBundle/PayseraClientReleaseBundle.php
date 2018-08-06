<?php

namespace Paysera\Bundle\ClientReleaseBundle;

use Paysera\Component\DependencyInjection\AddTaggedCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PayseraClientReleaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_client_release.api_config_builder',
            'paysera_client_release.client_definition_builder',
            'addClientDefinitionBuilder',
            ['type']
        ));
        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_client_release.release_cycle_manager',
            'paysera_client_release.release_step',
            'addReleaseStep',
            ['type', 'position']
        ));
    }
}
