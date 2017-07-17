<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class DetailsOptions extends Entity
{
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
