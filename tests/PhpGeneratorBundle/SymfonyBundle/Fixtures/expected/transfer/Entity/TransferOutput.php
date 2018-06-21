<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Evp\Component\Money\Money;

class TransferOutput extends TransferInput
{
    const STATUS_NEW = 'new';
    const STATUS_REGISTERED = 'registered';
    const STATUS_WAITING_FUNDS = 'waiting_funds';
    const STATUS_WAITING_REGISTRATION = 'waiting_registration';
    const STATUS_WAITING_PASSWORD = 'waiting_password';
    const STATUS_RESERVED = 'reserved';
    const STATUS_FROZEN = 'frozen';
    const STATUS_PROCESSING = 'processing';
    const STATUS_DONE = 'done';
    const STATUS_REJECTED = 'rejected';
    const STATUS_REVOKED = 'revoked';
    const STATUS_FAILED = 'failed';

    private $id;
    private $status;
    private $initiator;
    private $createdAt;
    private $performedAt;
    private $failureStatus;
    private $outCommissionAmount;
    private $outCommissionCurrency;
    private $additionalInformation;

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
    /**
     * @return TransferInitiator
     */
    public function getInitiator()
    {
        return $this->initiator;
    }
    /**
     * @param TransferInitiator $initiator
     * @return $this
     */
    public function setInitiator(TransferInitiator $initiator)
    {
        $this->initiator = $initiator;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getPerformedAt()
    {
        return $this->performedAt;
    }
    /**
     * @param \DateTimeInterface $performedAt
     * @return $this
     */
    public function setPerformedAt(\DateTimeInterface $performedAt)
    {
        $this->performedAt = $performedAt;
        return $this;
    }
    /**
     * @return TransferFailureStatus|null
     */
    public function getFailureStatus()
    {
        return $this->failureStatus;
    }
    /**
     * @param TransferFailureStatus $failureStatus
     * @return $this
     */
    public function setFailureStatus(TransferFailureStatus $failureStatus)
    {
        $this->failureStatus = $failureStatus;
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getOutCommission()
    {
        if ($this->outCommissionAmount === null && $this->outCommissionCurrency === null) {
            return null;
        }
        return new Money($this->outCommissionAmount, $this->outCommissionCurrency);
    }
    /**
     * @param Money $outCommission
     * @return $this
     */
    public function setOutCommission(Money $outCommission)
    {
        $this->outCommissionAmount = $outCommission->getAmount();
        $this->outCommissionCurrency = $outCommission->getCurrency();
        return $this;
    }
    /**
     * @return TransferAdditionalData|null
     */
    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }
    /**
     * @param TransferAdditionalData $additionalInformation
     * @return $this
     */
    public function setAdditionalInformation(TransferAdditionalData $additionalInformation)
    {
        $this->additionalInformation = $additionalInformation;
        return $this;
    }

}
