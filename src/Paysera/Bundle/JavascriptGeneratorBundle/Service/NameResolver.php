<?php

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service;

use Doctrine\Common\Inflector\Inflector;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;
use Paysera\Component\StringHelper;

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

    public function getPackageName(string $vendor, ApiDefinition $api) : string
    {
        return sprintf('%s-%s-client', $vendor, StringHelper::kebabCase($api->getNamespace()));
    }

    public function getAngularJsModuleName(string $vendor, string $apiName) : string
    {
        return sprintf('%s.http.%s', $vendor, $apiName);
    }

    public function getAngularJsFactoryClassName(string $vendor, string $apiName) : string
    {
        return sprintf('%sHttp%sClientFactory', $vendor, ucfirst(Inflector::classify($apiName)));
    }
}
