<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

class TypeConfigurationProviderStorage
{
    /**
     * @var TypeConfigurationProvider[]
     */
    private $typeConfigurationProviders;

    public function __construct()
    {
        $this->typeConfigurationProviders = [];
    }

    public function addTypeConfigurationProvider(TypeConfigurationProvider $configurationProvider, string $language)
    {
        $this->typeConfigurationProviders[$language] = $configurationProvider;
    }

    public function getTypeConfigurationProvider(string $language): TypeConfigurationProvider
    {
        return $this->typeConfigurationProviders[$language];
    }
}
