<?php

namespace Paysera\Test\TransferClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class DetailsOptions extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return boolean|null
     */
    public function isPreserve()
    {
        return $this->get('preserve');
    }
    /**
     * @param boolean $preserve
     * @return $this
     */
    public function setPreserve($preserve)
    {
        $this->set('preserve', $preserve);
        return $this;
    }
}
