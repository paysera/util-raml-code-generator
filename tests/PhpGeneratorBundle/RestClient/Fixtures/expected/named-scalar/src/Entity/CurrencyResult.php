<?php

namespace Paysera\Test\NamedScalarClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class CurrencyResult extends Result
{
    protected function createItem($data)
    {
        return $data;
    }
}
