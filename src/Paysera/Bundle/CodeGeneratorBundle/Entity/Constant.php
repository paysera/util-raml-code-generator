<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity;

class Constant
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

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
     * @return Constant
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Constant
     */
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }
}
