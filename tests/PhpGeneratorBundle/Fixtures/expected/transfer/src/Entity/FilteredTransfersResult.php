<?php

namespace Paysera\Test\TransferClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class FilteredTransfersResult extends Result
{
    protected function createItem(array $data)
    {
        return new TransferOutput($data);
    }
}
