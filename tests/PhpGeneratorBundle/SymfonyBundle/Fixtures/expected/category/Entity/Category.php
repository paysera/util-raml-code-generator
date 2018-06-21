<?php

namespace Vendor\Test\CategoryApiBundle\Entity;

class Category
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    private $id;
    private $parentId;
    private $titles;
    private $status;

    public function __construct()
    {
                
        $this->titles = [];    
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
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
    /**
     * @return string[]
     */
    public function getTitles()
    {
        return $this->titles;
    }
    /**
     * @param string[] $titles
     * @return $this
     */
    public function setTitles(array $titles)
    {
        $this->titles = $titles;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}
