<?php

namespace Paysera\Test\NullableTypesClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Inquiry extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
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
    public function getQuestion()
    {
        return $this->get('question');
    }
    /**
     * @param string $question
     * @return $this
     */
    public function setQuestion($question)
    {
        $this->set('question', $question);
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
     * @return boolean|null
     */
    public function isFulfilled()
    {
        return $this->get('fulfilled');
    }
    /**
     * @param boolean $fulfilled
     * @return $this
     */
    public function setFulfilled($fulfilled)
    {
        $this->set('fulfilled', $fulfilled);
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getReviewedAt()
    {
        if ($this->get('reviewed_at') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:sP', $this->get('reviewed_at'));
    }
    /**
     * @param \DateTimeInterface $reviewedAt
     * @return $this
     */
    public function setReviewedAt(\DateTimeInterface $reviewedAt)
    {
        $this->set('reviewed_at', $reviewedAt->format('Y-m-d\TH:i:sP'));
        return $this;
    }
    /**
     * @return Reviewer|null
     */
    public function getReviewer()
    {
        if ($this->get('reviewer') === null) {
            return null;
        }
        return (new Reviewer())->setDataByReference($this->getByReference('reviewer'));
    }
    /**
     * @param Reviewer $reviewer
     * @return $this
     */
    public function setReviewer(Reviewer $reviewer)
    {
        $this->setByReference('reviewer', $reviewer->getDataByReference());
        return $this;
    }
}
