<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Evp\Component\Money\Money;

class TransferInput
{
    const CHARGE_TYPE_SHA = 'SHA';
    const CHARGE_TYPE_OUR = 'OUR';
    const URGENCY_STANDARD = 'standard';
    const URGENCY_URGENT = 'urgent';

    private $id;
    private $amountAmount;
    private $amountCurrency;
    private $beneficiary;
    private $payer;
    private $finalBeneficiary;
    private $performAt;
    private $chargeType;
    private $urgency;
    private $notifications;
    private $purpose;
    private $password;
    private $cancelable;
    private $autoCurrencyConvert;
    private $autoChargeRelatedCard;
    private $reserveUntil;

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
     * @return Money
     */
    public function getAmount()
    {
        return new Money($this->amountAmount, $this->amountCurrency);
    }
    /**
     * @param Money $amount
     * @return $this
     */
    public function setAmount(Money $amount)
    {
        $this->amountAmount = $amount->getAmount();
        $this->amountCurrency = $amount->getCurrency();
        return $this;
    }
    /**
     * @return TransferBeneficiary
     */
    public function getBeneficiary()
    {
        return $this->beneficiary;
    }
    /**
     * @param TransferBeneficiary $beneficiary
     * @return $this
     */
    public function setBeneficiary(TransferBeneficiary $beneficiary)
    {
        $this->beneficiary = $beneficiary;
        return $this;
    }
    /**
     * @return Payer
     */
    public function getPayer()
    {
        return $this->payer;
    }
    /**
     * @param Payer $payer
     * @return $this
     */
    public function setPayer(Payer $payer)
    {
        $this->payer = $payer;
        return $this;
    }
    /**
     * @return FinalBeneficiary|null
     */
    public function getFinalBeneficiary()
    {
        return $this->finalBeneficiary;
    }
    /**
     * @param FinalBeneficiary $finalBeneficiary
     * @return $this
     */
    public function setFinalBeneficiary(FinalBeneficiary $finalBeneficiary)
    {
        $this->finalBeneficiary = $finalBeneficiary;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getPerformAt()
    {
        return $this->performAt;
    }
    /**
     * @param \DateTimeInterface $performAt
     * @return $this
     */
    public function setPerformAt(\DateTimeInterface $performAt)
    {
        $this->performAt = $performAt;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getChargeType()
    {
        return $this->chargeType;
    }
    /**
     * @param string $chargeType
     * @return $this
     */
    public function setChargeType($chargeType)
    {
        $this->chargeType = $chargeType;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getUrgency()
    {
        return $this->urgency;
    }
    /**
     * @param string $urgency
     * @return $this
     */
    public function setUrgency($urgency)
    {
        $this->urgency = $urgency;
        return $this;
    }
    /**
     * @return TransferNotifications|null
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
    /**
     * @param TransferNotifications $notifications
     * @return $this
     */
    public function setNotifications(TransferNotifications $notifications)
    {
        $this->notifications = $notifications;
        return $this;
    }
    /**
     * @return TransferPurpose
     */
    public function getPurpose()
    {
        return $this->purpose;
    }
    /**
     * @param TransferPurpose $purpose
     * @return $this
     */
    public function setPurpose(TransferPurpose $purpose)
    {
        $this->purpose = $purpose;
        return $this;
    }
    /**
     * @return TransferPassword34|null
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param TransferPassword34 $password
     * @return $this
     */
    public function setPassword(TransferPassword34 $password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isCancelable()
    {
        return $this->cancelable;
    }
    /**
     * @param boolean $cancelable
     * @return $this
     */
    public function setCancelable($cancelable)
    {
        $this->cancelable = $cancelable;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAutoCurrencyConvert()
    {
        return $this->autoCurrencyConvert;
    }
    /**
     * @param boolean $autoCurrencyConvert
     * @return $this
     */
    public function setAutoCurrencyConvert($autoCurrencyConvert)
    {
        $this->autoCurrencyConvert = $autoCurrencyConvert;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAutoChargeRelatedCard()
    {
        return $this->autoChargeRelatedCard;
    }
    /**
     * @param boolean $autoChargeRelatedCard
     * @return $this
     */
    public function setAutoChargeRelatedCard($autoChargeRelatedCard)
    {
        $this->autoChargeRelatedCard = $autoChargeRelatedCard;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getReserveUntil()
    {
        return $this->reserveUntil;
    }
    /**
     * @param \DateTimeInterface $reserveUntil
     * @return $this
     */
    public function setReserveUntil(\DateTimeInterface $reserveUntil)
    {
        $this->reserveUntil = $reserveUntil;
        return $this;
    }

}
