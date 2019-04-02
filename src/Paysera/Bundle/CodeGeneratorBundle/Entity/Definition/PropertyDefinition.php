<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Constant;

class PropertyDefinition
{
    const TYPE_INTEGER = 'integer';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_STRING = 'string';
    const TYPE_OBJECT = 'object';
    const TYPE_ARRAY = 'array';
    const TYPE_NUMBER = 'number';
    const TYPE_REFERENCE = 'reference';
    const TYPE_FILE = 'file';

    protected static $simpleTypes = [
        self::TYPE_INTEGER,
        self::TYPE_BOOLEAN,
        self::TYPE_OBJECT,
        self::TYPE_ARRAY,
        self::TYPE_STRING,
        self::TYPE_NUMBER,
    ];

    protected static $scalarTypes = [
        self::TYPE_INTEGER,
        self::TYPE_STRING,
        self::TYPE_BOOLEAN,
    ];

    /**
     * @var array
     */
    private $ramlPrimitiveTypesMap;

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
    private $description;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var Constant[]
     */
    private $constants;

    public static function getSimpleTypes()
    {
        return self::$simpleTypes;
    }

    public static function getScalarTypes()
    {
        return self::$scalarTypes;
    }

    public function __construct()
    {
        $this->required = false;
        $this->constants = [];
        $this->ramlPrimitiveTypesMap = [
            PropertyDefinition::TYPE_NUMBER => PropertyDefinition::TYPE_STRING,
        ];
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
        if (isset($this->ramlPrimitiveTypesMap[$type])) {
            $type = $this->ramlPrimitiveTypesMap[$type];
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $required
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return Constant[]
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @param Constant[] $constants
     *
     * @return PropertyDefinition
     */
    public function setConstants(array $constants)
    {
        $this->constants = $constants;

        return $this;
    }

    public function isSimpleType()
    {
        return in_array($this->type, self::$simpleTypes, true);
    }
}
