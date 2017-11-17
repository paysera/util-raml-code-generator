<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class RulesResult extends Result
{
    protected function createItem(array $data)
    {
        return new Rule($data);
    }
}
