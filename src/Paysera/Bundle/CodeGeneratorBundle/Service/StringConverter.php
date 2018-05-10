<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Doctrine\Common\Inflector\Inflector;

class StringConverter
{
    public function convertSlugToClassName(string $slug) : string
    {
        return Inflector::classify($slug);
    }

    public function convertSlugToVariableName(string $string) : string
    {
        if (strpos($string, '.') !== false) {
            $string = substr($string, strpos($string, '.') + 1);
        }
        return lcfirst(Inflector::classify($string));
    }

    public function extractTypeName(string $name): string
    {
        if (strpos($name, '.') !== false) {
            return substr($name, strpos($name, '.') + 1);
        }
        return $name;
    }
}
