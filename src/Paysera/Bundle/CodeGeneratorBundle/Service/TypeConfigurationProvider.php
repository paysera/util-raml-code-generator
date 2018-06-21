<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\TypeConfiguration;

class TypeConfigurationProvider
{
    /**
     * @var TypeConfiguration[]
     */
    private $config;
    private $default;
    /**
     * @var TypeConfiguration|null
     */
    private $entityTypeConfiguration;

    public function __construct(
        TypeConfiguration $default,
        TypeConfiguration $entityTypeConfiguration = null
    ) {
        $this->default = $default;
        $this->entityTypeConfiguration = $entityTypeConfiguration;
        $this->config = [];
    }

    public function addTypeConfiguration(TypeConfiguration $configuration)
    {
        $this->config[] = $configuration;
    }

    public function getPropertyTypeConfiguration(PropertyDefinition $property): TypeConfiguration
    {
        $type = $property->getType();
        if ($property instanceof DateTimePropertyDefinition) {
            $type = 'DateTime';
        }
        if ($property->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $type = $property->getReference();
        }

        return $this->getTypeConfiguration($type);
    }

    public function hasTypeConfiguration(string $type): bool
    {
        $key = strtolower($type);
        foreach ($this->config as $item) {
            if (preg_match('#' . $item->getMatchRegex() . '#', $key) === 1) {
                return true;
            }
        }
        return false;
    }

    public function getTypeConfiguration(string $type): TypeConfiguration
    {
        $key = strtolower($type);
        foreach ($this->config as $item) {
            if (preg_match('#' . $item->getMatchRegex() . '#', $key) === 1) {
                return $item;
            }
        }

        return $this->default;
    }

    public function getEntityTypeConfiguration()
    {
        return $this->entityTypeConfiguration;
    }
}
