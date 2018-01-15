<?php

namespace Paysera\Component;

use Doctrine\Common\Inflector\Inflector;

class StringHelper
{
    public static function kebabCase($string)
    {
        return strtr(Inflector::tableize($string), ['_' => '-']);
    }
}
