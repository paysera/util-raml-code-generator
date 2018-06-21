<?php

namespace Paysera\Component;

use Doctrine\Common\Inflector\Inflector;

class StringHelper
{
    public static function kebabCase($string)
    {
        return strtr(Inflector::tableize($string), ['_' => '-']);
    }

    public static function snakeCase($string)
    {
        return Inflector::tableize($string);
    }

    public static function isPlural($word)
    {
        return Inflector::pluralize($word) === $word;
    }

    public static function plural($word)
    {
        return Inflector::pluralize($word);
    }

    public static function singular($word)
    {
        return Inflector::singularize($word);
    }
}
