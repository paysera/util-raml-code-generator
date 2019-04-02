<?php

namespace Paysera\Test\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Category extends Entity
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
    /**
     * @return string
     */
    public function getPhoto()
    {
        return base64_decode($this->get('photo'));
    }
    /**
     * @param string $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->set('photo', base64_encode($photo));
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAvatar()
    {
        if ($this->get('avatar') === null) {
            return null;
        }
        return base64_decode($this->get('avatar'));
    }
    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        if ($avatar === null) {
            $this->set('avatar', null);
            return $this;
        }
        $this->set('avatar', base64_encode($avatar));
        return $this;
    }
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
    /**
     * @return string[]
     */
    public function getTitles()
    {
        return $this->get('titles');
    }
    /**
     * @param string[] $titles
     * @return $this
     */
    public function setTitles(array $titles)
    {
        $this->set('titles', $titles);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->set('status', $status);
        return $this;
    }
}
