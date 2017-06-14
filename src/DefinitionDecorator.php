<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\FilterTypeDefinition;
use Raml\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\PropertyDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ResultTypeDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\TypeDefinition;
use Paysera\Util\RamlCodeGenerator\Exception\InvalidDefinitionException;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition as DecoratedDefinition;

class DefinitionDecorator
{
    const ANNOTATION_ENTITY = '(entity_type)';

    private $definitionValidator;

    public function __construct(DefinitionValidator $definitionValidator)
    {
        $this->definitionValidator = $definitionValidator;
    }

    public function decorate(
        ApiDefinition $original,
        string $apiName,
        string $namespace
    ) {
        $apiDefinition = new DecoratedDefinition($original);
        $types = array_merge(
            $this->buildTypeDefinitions($original),
            $this->buildTraitTypeDefinitions($original)
        );

        $apiDefinition
            ->setTypes($types)
            ->setName($apiName)
            ->setNamespace($namespace)
        ;

        $this->definitionValidator->validateDefinition($apiDefinition);

        return $apiDefinition;
    }

    /**
     * @param ApiDefinition $apiDefinition
     * @return TypeDefinition[]
     */
    private function buildTypeDefinitions(ApiDefinition $apiDefinition)
    {
        $types = [];
        foreach ($apiDefinition->getTypes() as $name => $definition) {
            if (strpos($name, 'Metadata') !== false) {
                continue;
            } elseif (
                strpos($name, 'Result') !== false
                && !array_key_exists(self::ANNOTATION_ENTITY, $definition)
            ) {
                $types[] = $this->buildResultTypeDefinition($name, $definition);
            } else {
                $types[] = $this->buildTypeDefinition($name, $definition);
            }
        }

        return $types;
    }

    /**
     * @param ApiDefinition $apiDefinition
     * @return TypeDefinition[]
     */
    private function buildTraitTypeDefinitions(ApiDefinition $apiDefinition)
    {
        $types = [];
        $traits = $apiDefinition->getTraits();
        $extendsBaseFilter = false;

        if (array_key_exists('Filter', $traits) || array_key_exists('filter', $traits)) {
            $extendsBaseFilter = true;
            unset($traits['Filter']);
            unset($traits['filter']);
        }

        foreach ($traits as $name => $definition) {
            $types[] = $this->buildFilterTypeDefinition($name, $definition, $extendsBaseFilter);
        }

        return array_filter($types);
    }

    /**
     * @param string $name
     * @param array $definition
     * @param bool $extendsBaseFilter
     * @return FilterTypeDefinition
     * @throws InvalidDefinitionException
     */
    private function buildFilterTypeDefinition(string $name, array $definition, bool $extendsBaseFilter)
    {
        $type = new FilterTypeDefinition();
        $this->populateBasicTypeFields($type, $name, $definition);

        $fields = null;

        if (isset($definition['properties'])) {
            $fields = $definition['properties'];
        } elseif (isset($definition['queryParameters'])) {
            $fields = $definition['queryParameters'];
        }

        if ($fields === null) {
            return null;
        }

        foreach ($fields as $propertyName => $propertyDefinition) {
            $property = $this->buildPropertyDefinition($propertyName, $propertyDefinition);
            $type->addProperty($property);
        }

        $type
            ->setExtendsBaseFilter($extendsBaseFilter)
        ;

        return $type;
    }

    /**
     * @param string $name
     * @param array $definition
     * @return ResultTypeDefinition
     * @throws InvalidDefinitionException
     */
    private function buildResultTypeDefinition($name, array $definition)
    {
        $type = new ResultTypeDefinition();
        $this->populateBasicTypeFields($type, $name, $definition);

        if (empty($definition['properties'])) {
            throw new InvalidDefinitionException('ResultType definition must contain "properties" list');
        }

        $dataKey = array_diff(array_keys($definition['properties']), ['_metadata'])[0];
        $itemsType = $definition['properties'][$dataKey]['items']['type'];

        $type
            ->setDataKey($dataKey)
            ->setItemsType($itemsType)
        ;

        return $type;
    }

    /**
     * @param string $name
     * @param array $definition
     * @return TypeDefinition
     */
    private function buildTypeDefinition($name, array $definition)
    {
        $type = new TypeDefinition();
        $this->populateBasicTypeFields($type, $name, $definition);

        foreach ($definition['properties'] as $propertyName => $propertyDefinition) {
            $property = $this->buildPropertyDefinition($propertyName, $propertyDefinition);
            $type->addProperty($property);
        }

        return $type;
    }

    /**
     * @param string $name
     * @param array $definition
     * @return PropertyDefinition
     */
    private function buildPropertyDefinition($name, array $definition)
    {
        $property = new PropertyDefinition();
        if (isset($definition['type']) && $definition['type'] === PropertyDefinition::TYPE_ARRAY) {
            $property = new ArrayPropertyDefinition();
            $property
                ->setItemsType($definition['items']['type'])
            ;
        }

        $property
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDescription(isset($definition['description']) ? $definition['description'] : null)
            ->setRequired(isset($definition['required']) ? $definition['required'] : false)
        ;

        if (isset($definition['type']) && strpos($definition['type'], '[]') !== false) {
            $property->setType(PropertyDefinition::TYPE_ARRAY);
        }

        if (!in_array($property->getType(), PropertyDefinition::getSimpleTypes(), true)) {
            $property
                ->setType(PropertyDefinition::TYPE_REFERENCE)
                ->setReference(isset($definition['type']) ? $definition['type'] : null)
            ;
        }

        return $property;
    }

    private function populateBasicTypeFields(TypeDefinition $type, string $name, array $definition)
    {
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
        ;
    }
}
