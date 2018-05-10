<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class FilterTypeDefinition extends TypeDefinition
{
    const BASE_FILTER = 'Filter';

    public function __construct()
    {
        parent::__construct();
    }
}
