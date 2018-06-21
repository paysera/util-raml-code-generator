<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

class Review
{
    private $id;
    private $reviewerUserId;
    private $comment;
    private $internalComment;

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
     * @return string|null
     */
    public function getReviewerUserId()
    {
        return $this->reviewerUserId;
    }
    /**
     * @param string $reviewerUserId
     * @return $this
     */
    public function setReviewerUserId($reviewerUserId)
    {
        $this->reviewerUserId = $reviewerUserId;
        return $this;
    }
    /**
     * @return string|null
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
    /**
     * @return string|null
     */
    public function getInternalComment()
    {
        return $this->internalComment;
    }
    /**
     * @param string $internalComment
     * @return $this
     */
    public function setInternalComment($internalComment)
    {
        $this->internalComment = $internalComment;
        return $this;
    }

}
