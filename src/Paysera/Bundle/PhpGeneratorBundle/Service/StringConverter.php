<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service;

use Doctrine\Common\Inflector\Inflector;

class StringConverter
{
    public function convertSlugToClassName(string $slug) : string
    {
        return Inflector::classify($slug);
    }

    public function convertSlugToVariableName(string $string) : string
    {
        return lcfirst(Inflector::classify($string));
    }
}
