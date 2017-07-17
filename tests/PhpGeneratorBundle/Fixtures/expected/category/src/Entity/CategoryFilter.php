<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class CategoryFilter extends Filter
{
    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->get('parent_id');
    }

    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->set('parent_id', $parentId);
        return $this;
    }

}
