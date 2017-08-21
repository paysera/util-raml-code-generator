<?php

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service;

use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;

class NameResolver
{
    private $converter;

    public function __construct(StringConverter $converter)
    {
        $this->converter = $converter;
    }

    public function getClientName(string $name) : string
    {
        return sprintf('%sClient', $this->converter->convertSlugToClassName($name));
    }

    public function getPackageName(string $vendor, string $apiName) : string
    {
        return sprintf('%s-%s-client', $vendor, $apiName);
    }

    public function getAngularJsModuleName(string $vendor, string $apiName) : string
    {
        return sprintf('%s.http.%s', $vendor, $apiName);
    }

    public function getAngularJsFactoryClassName(string $vendor, string $apiName) : string
    {
        return sprintf('%sHttp%sClientFactory', $vendor, ucfirst($apiName));
    }
}
