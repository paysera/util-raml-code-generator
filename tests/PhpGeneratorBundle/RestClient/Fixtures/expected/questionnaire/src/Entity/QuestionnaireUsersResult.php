<?php

namespace Paysera\Test\QuestionnaireClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class QuestionnaireUsersResult extends Result
{
    protected function createItem($data)
    {
        return $data;
    }
}
