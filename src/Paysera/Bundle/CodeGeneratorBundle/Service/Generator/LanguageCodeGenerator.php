<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;

class LanguageCodeGenerator implements LanguageCodeGeneratorInterface
{
    /**
     * @var GeneratorInterface[]
     */
    private $generators;

    public function __construct()
    {
        $this->generators = [];
    }

    public function addGenerator(GeneratorInterface $generator, string $position)
    {
        $this->generators[$position] = $generator;
        ksort($this->generators);
    }

    public function generate(ApiDefinition $definition): array
    {
        $items = [];
        foreach ($this->generators as $generator) {
            $items[] = $generator->generate($definition);
        }

        return call_user_func_array('array_merge', $items);
    }
}
