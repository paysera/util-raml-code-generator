<?php

namespace Paysera\Component;

use Doctrine\Common\Inflector\Inflector;

class StringHelper
{
    public static function kebabCase($string)
    {
        return strtr(Inflector::tableize($string), ['_' => '-']);
    }

    public static function isPlural($word)
    {
        return Inflector::pluralize($word) === $word;
    }
}
