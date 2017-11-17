<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class WhitelistsResult extends Result
{
    protected function createItem(array $data)
    {
        return new Whitelist($data);
    }
}
