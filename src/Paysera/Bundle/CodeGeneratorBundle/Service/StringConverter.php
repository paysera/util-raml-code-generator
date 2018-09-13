<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Doctrine\Common\Inflector\Inflector;

class StringConverter
{
    const RESERVED_KEYWORD_PREFIX = '_';

    /**
     * @var ReservedKeywordDetector[]
     */
    private $reservedKeywordDetectors;

    public function __construct()
    {
        $this->reservedKeywordDetectors = [];
    }

    public function convertSlugToClassName(string $slug): string
    {
        return Inflector::classify($slug);
    }

    public function convertSlugToVariableName(string $string): string
    {
        if (strpos($string, '.') !== false) {
            $string = substr($string, strpos($string, '.') + 1);
        }

        return lcfirst(Inflector::classify($string));
    }

    public function convertSlugToVariableNameByCodeType(string $string, string $codeType): string
    {
        $variableName = $this->convertSlugToVariableName($string);
        foreach ($this->reservedKeywordDetectors as $detector) {
            if ($detector->isTypeSupported($codeType) && $detector->isReservedKeyword($string)) {
                return sprintf('%s%s', self::RESERVED_KEYWORD_PREFIX, $variableName);
            }
        }

        return $variableName;
    }

    public function extractTypeName(string $name): string
    {
        if (strpos($name, '.') !== false) {
            return substr($name, strpos($name, '.') + 1);
        }

        return $name;
    }

    public function addReservedKeywordDetector(ReservedKeywordDetector $detector)
    {
        $this->reservedKeywordDetectors[] = $detector;
    }
}
