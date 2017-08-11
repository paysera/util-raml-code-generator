<?php

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service;

use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;

class ClientNameResolver
{
    private $converter;

    public function __construct(StringConverter $converter)
    {
        $this->converter = $converter;
    }

    public function getClientName(string $name) : string
    {
        //return $this->converter->convertSlugToClassName($definition->getName()) . 'Client';
        return $this->converter->convertSlugToClassName($name) . 'Client';
    }
}
