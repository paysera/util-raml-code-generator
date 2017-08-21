<?php

namespace Paysera\Bundle\JavascriptGeneratorBundle;

use Paysera\Component\DependencyInjection\AddTaggedCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PayseraJavascriptGeneratorBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddTaggedCompilerPass(
            'paysera_javascript_generator.language_code_generator',
            'paysera_js_generator',
            'addGenerator',
            ['position']
        ));
    }
}
