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

    public function addTypeConfigurationProvider(TypeConfigurationProvider $configurationProvider, string $type)
    {
        $this->typeConfigurationProviders[$type] = $configurationProvider;
    }

    public function getTypeConfigurationProvider(string $type): TypeConfigurationProvider
    {
        return $this->typeConfigurationProviders[$type];
    }
}
