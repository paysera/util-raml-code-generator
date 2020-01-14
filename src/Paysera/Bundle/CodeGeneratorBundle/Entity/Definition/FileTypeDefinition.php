<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class FileTypeDefinition extends TypeDefinition
{
    const BASE_FILE = 'File';

    public function __construct()
    {
        parent::__construct();
    }
}
