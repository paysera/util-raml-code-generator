<?php

namespace Paysera\Test\TransferSurveillanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Review extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getReviewerUserId()
    {
        return $this->get('reviewer_user_id');
    }
    /**
     * @param string $reviewerUserId
     * @return $this
     */
    public function setReviewerUserId($reviewerUserId)
    {
        $this->set('reviewer_user_id', $reviewerUserId);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->get('comment');
    }
    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->set('comment', $comment);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getInternalComment()
    {
        return $this->get('internal_comment');
    }
    /**
     * @param string $internalComment
     * @return $this
     */
    public function setInternalComment($internalComment)
    {
        $this->set('internal_comment', $internalComment);
        return $this;
    }
}
