<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Constant;

class ConstantBuilder
{
    const PATTERN_REDEFINE_CONSTANT_CHARACTERS = '/[^a-z0-9A-Z]/';

    public function build(string $name, array $values) : array
    {
        $constants = [];

        foreach ($values as $value) {
            $constants[] = (new Constant())
                ->setName($this->buildName($name, $value))
                ->setValue($value)
            ;
        }

        return $constants;
    }

    private function buildName(string $name, string $value) : string
    {
        return mb_strtoupper(
            sprintf(
                '%s_%s',
                $this->sanitizeString($name),
                $this->sanitizeString($value)
            )
        );
    }

    private function sanitizeString(string $string) : string
    {
        return preg_replace(self::PATTERN_REDEFINE_CONSTANT_CHARACTERS, '_', $string);
    }
}
