<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

class ReservedKeywordDetector
{
    /**
     * @var array
     */
    private $keywords;

    /**
     * @var string
     */
    private $type;

    public function __construct()
    {
        $this->keywords = [];
    }

    public function setKeywords(array $keywords) : self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function setType(string $type) : self
    {
        $this->type = $type;

        return $this;
    }

    public function isTypeSupported(string $type) : bool
    {
        return $type === $this->type;
    }

    public function isReservedKeyword(string $keyword) : bool
    {
        return in_array($keyword, $this->keywords, true);
    }
}
