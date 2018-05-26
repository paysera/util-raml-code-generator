<?php

namespace Paysera\Test\TransferSurveillanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class RulesResult extends Result
{
    protected function createItem(array $data)
    {
        return new Rule($data);
    }
}
