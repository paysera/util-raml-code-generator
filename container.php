<?php

$container = new Pimple\Container();

$configFile = 'config/parameters.yml';
if (!file_exists($configFile)) {
    $configFile = __DIR__ . 'config/parameters.dist.yml';
}

$config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($configFile));

if ($config === null) {
    throw new \Exception('"parameters.yml" or "parameters.dist.yml" should exist in "config" directory');
}

foreach ($config['parameters'] as $key => $item) {
    $container['parameters.' . $key] = $item;
}
$container['parameters.twig'] = $config['twig'];

$container['twig'] = function ($c) {
    $loader = new \Twig_Loader_Filesystem($c['parameters.template_directories']);

    $twig = new \Twig_Environment($loader, $c['parameters.twig']['options']);

    $twig->addExtension(new \Paysera\Util\RamlCodeGenerator\Twig\FieldDefinitionExtension());
    $twig->addExtension(new \Paysera\Util\RamlCodeGenerator\Twig\ApiMethodExtension());

    if (isset($c['parameters.twig']['options']) && $c['parameters.twig']['options']) {
        $twig->addExtension(new \Twig_Extension_Debug());
    }

    if (isset($c['parameters.twig']['global_variables'])) {
        foreach ($c['parameters.twig']['global_variables'] as $name => $value) {
            $twig->addGlobal($name, $value);
        }
    }

    return $twig;
};

$container['raml_parser'] = function ($c) {
    return new \Raml\Parser();
};

$container['filesystem'] = function ($c) {
    return new \Symfony\Component\Filesystem\Filesystem();
};

$container['definition_decorator'] = function ($c) {
    return new \Paysera\Util\RamlCodeGenerator\DefinitionDecorator();
};

$container['code_generator.entity'] = function ($c) {
    return new \Paysera\Util\RamlCodeGenerator\Generator\EntityGenerator(
        $c['twig']
    );
};

$container['code_generator.client_factory'] = function ($c) {
    return new \Paysera\Util\RamlCodeGenerator\Generator\ClientFactoryGenerator(
        $c['twig']
    );
};

$container['code_generator.composer_json'] = function ($c) {
    return new \Paysera\Util\RamlCodeGenerator\Generator\ComposerJsonGenerator(
        $c['twig']
    );
};

$container['code_generator.client'] = function ($c) {
    return new \Paysera\Util\RamlCodeGenerator\Generator\ClientGenerator(
        $c['twig']
    );
};

$container['code_generator'] = function ($c) {
    $generator = new \Paysera\Util\RamlCodeGenerator\CodeGenerator(
        $c['raml_parser'],
        $c['filesystem'],
        $c['definition_decorator'],
        $c['parameters.raml_directory'],
        $c['parameters.generated_directory']
    );

    $generator->addGenerator($c['code_generator.entity']);
    $generator->addGenerator($c['code_generator.client_factory']);
    $generator->addGenerator($c['code_generator.client']);
    $generator->addGenerator($c['code_generator.composer_json']);

    return $generator;
};
