<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class DateTimeTypeDefinition extends TypeDefinition
{
    const ANNOTATION_TIMESTAMP = '(datetime_timestamp)';

    const FORMAT_DATETIME = 'datetime';
    const FORMAT_DATETIME_ONLY = 'datetime-only';
    const FORMAT_DATE_ONLY = 'date-only';
    const FORMAT_TIME_ONLY = 'time-only';

    const NAME = 'datetime';

    public static $supportedTypes = [
        self::FORMAT_DATETIME,
        self::FORMAT_DATETIME_ONLY,
        self::FORMAT_DATE_ONLY,
        self::FORMAT_TIME_ONLY,
    ];
}
