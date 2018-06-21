<?php

namespace Paysera\Test\TransferSurveillanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class MatchersResult extends Result
{
    protected function createItem(array $data)
    {
        return new Matcher($data);
    }
}
