<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;

interface CodeGeneratorInterface
{
    /**
     * @param ApiDefinition $definition
     *
     * @return SourceCode[]
     */
    public function generate(ApiDefinition $definition) : array;
}
