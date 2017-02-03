<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class WebmoneyAccount extends Entity
{
    /**
     * @return string
     */
    public function getPurse()
    {
        return $this->get('purse');
    }
    /**
     * @param string $purse
     * @return $this
     */
    public function setPurse($purse)
    {
        $this->set('purse', $purse);
        return $this;
    }
}
