<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferOutput extends Entity
{
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
     * @return TransferInitiator
     */
    public function getInitiator()
    {
        return (new TransferInitiator())->setDataByReference($this->getByReference('initiator'));
    }
    /**
     * @param TransferInitiator $initiator
     * @return $this
     */
    public function setInitiator(TransferInitiator $initiator)
    {
        $this->setByReference('initiator', $initiator->getDataByReference());
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
    /**
     * @return \DateTimeImmutable|null
     */
    public function getPerformedAt()
    {
        return (new \DateTimeImmutable())->setTimestamp($this->get('performed_at'));
    }
    /**
     * @param \DateTimeInterface $performedAt
     * @return $this
     */
    public function setPerformedAt(\DateTimeInterface $performedAt)
    {
        $this->set('performed_at', $performedAt->getTimestamp());
        return $this;
    }
    /**
     * @return TransferFailureStatus|null
     */
    public function getFailureStatus()
    {
        return (new TransferFailureStatus())->setDataByReference($this->getByReference('failure_status'));
    }
    /**
     * @param TransferFailureStatus $failureStatus
     * @return $this
     */
    public function setFailureStatus(TransferFailureStatus $failureStatus)
    {
        $this->setByReference('failure_status', $failureStatus->getDataByReference());
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getOutCommission()
    {
        return (new Money())->setDataByReference($this->getByReference('out_commission'));
    }
    /**
     * @param Money $outCommission
     * @return $this
     */
    public function setOutCommission(Money $outCommission)
    {
        $this->setByReference('out_commission', $outCommission->getDataByReference());
        return $this;
    }
    /**
     * @return TransferAdditionalData|null
     */
    public function getAdditionalInformation()
    {
        return (new TransferAdditionalData())->setDataByReference($this->getByReference('additional_information'));
    }
    /**
     * @param TransferAdditionalData $additionalInformation
     * @return $this
     */
    public function setAdditionalInformation(TransferAdditionalData $additionalInformation)
    {
        $this->setByReference('additional_information', $additionalInformation->getDataByReference());
        return $this;
    }
}
