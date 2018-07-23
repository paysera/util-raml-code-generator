<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class DateTimePropertyDefinition extends PropertyDefinition
{
    private $format;

    /**
     * @return string|null
     */
    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }
}
