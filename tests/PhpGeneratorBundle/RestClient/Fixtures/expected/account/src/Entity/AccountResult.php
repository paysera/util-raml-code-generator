<?php

namespace Paysera\Test\AccountClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class AccountResult extends Result
{
    protected function createItem(array $data)
    {
        return new Account($data);
    }
}
