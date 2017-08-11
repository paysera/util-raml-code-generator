<?php

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service;

class PackageNameResolver
{
    public function getPackageName(string $vendor, string $apiName) : string
    {
        return sprintf('%s-%s-client', $vendor, $apiName);
    }
}
