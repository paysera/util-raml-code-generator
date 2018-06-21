<?php

namespace Vendor\Test\CategoryApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class CategoryFilter extends Filter
{
    private $parentId;

    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }
    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
}
