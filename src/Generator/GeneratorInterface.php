<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;

interface GeneratorInterface
{
    /**
     * @param ApiDefinition $definition
     *
     * @return SourceCode[]
     */
    public function generate(ApiDefinition $definition) : array;
}
