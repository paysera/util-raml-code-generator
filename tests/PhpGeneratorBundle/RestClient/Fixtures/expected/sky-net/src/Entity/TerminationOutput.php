<?php

namespace Paysera\Test\SkyNetClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TerminationOutput extends Entity
{
    const REFERENCE_TYPE_INFORMATION_REQUEST = 'information_request';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';

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
    public function getReferenceId()
    {
        return $this->get('reference_id');
    }
    /**
     * @param string $referenceId
     * @return $this
     */
    public function setReferenceId($referenceId)
    {
        $this->set('reference_id', $referenceId);
        return $this;
    }
    /**
     * @return string
     */
    public function getReferenceType()
    {
        return $this->get('reference_type');
    }
    /**
     * @param string $referenceType
     * @return $this
     */
    public function setReferenceType($referenceType)
    {
        $this->set('reference_type', $referenceType);
        return $this;
    }
    /**
     * @return string
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
    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_at'));
    }
    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->set('created_at', $createdAt->getTimestamp());
        return $this;
    }
}
