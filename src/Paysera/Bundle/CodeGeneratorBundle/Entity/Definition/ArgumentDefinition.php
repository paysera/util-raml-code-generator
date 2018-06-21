<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class ArgumentDefinition
{
    const TYPE_DEFAULT = 'string';
    const TYPE_ARRAY = 'array';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $namespacedType;

    /**
     * @var string
     */
    private $innerType;

    /**
     * @var string
     */
    private $importedType;

    /**
     * @var string
     */
    private $originalPlaceholder;

    /**
     * @var string
     */
    private $renamedName;

    public static function getScalarTypes()
    {
        return PropertyDefinition::getScalarTypes();
    }

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->type = self::TYPE_DEFAULT;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespacedType()
    {
        return $this->namespacedType;
    }

    /**
     * @param string $namespacedType
     *
     * @return $this
     */
    public function setNamespacedType($namespacedType)
    {
        $this->namespacedType = $namespacedType;

        return $this;
    }

    /**
     * @return string
     */
    public function getInnerType()
    {
        return $this->innerType;
    }

    /**
     * @param string $innerType
     *
     * @return $this
     */
    public function setInnerType($innerType)
    {
        $this->innerType = $innerType;
        return $this;
    }

    /**
     * @return string
     */
    public function getImportedType()
    {
        return $this->importedType;
    }

    /**
     * @param string $importedType
     *
     * @return $this
     */
    public function setImportedType($importedType)
    {
        $this->importedType = $importedType;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalPlaceholder()
    {
        return $this->originalPlaceholder;
    }

    /**
     * @param string $originalPlaceholder
     *
     * @return $this
     */
    public function setOriginalPlaceholder($originalPlaceholder)
    {
        $this->originalPlaceholder = $originalPlaceholder;
        return $this;
    }

    /**
     * @return string
     */
    public function getRenamedName()
    {
        return $this->renamedName;
    }

    /**
     * @param string $renamedName
     *
     * @return $this
     */
    public function setRenamedName($renamedName)
    {
        $this->renamedName = $renamedName;
        return $this;
    }
}
