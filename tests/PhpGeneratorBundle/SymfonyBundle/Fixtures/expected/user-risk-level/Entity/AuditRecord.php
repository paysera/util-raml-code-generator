<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Entity;

class AuditRecord
{
    private $id;
    private $comment;

    public function __construct()
    {
        
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

}
