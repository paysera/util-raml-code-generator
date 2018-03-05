<?php

namespace Paysera\Component;

class TypeHelper
{
    const TYPE_INTEGER = 'integer';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_STRING = 'string';
    const TYPE_OBJECT = 'object';
    const TYPE_ARRAY = 'array';
    const TYPE_NUMBER = 'number';

    private static $primitiveTypes = [
        self::TYPE_INTEGER,
        self::TYPE_BOOLEAN,
        self::TYPE_OBJECT,
        self::TYPE_ARRAY,
        self::TYPE_STRING,
        self::TYPE_NUMBER,
    ];

    public static function isPrimitiveType($type)
    {
        return in_array($type, self::$primitiveTypes, true);
    }
}
