<?php

namespace Paysera\Test\TransferClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferInput extends Entity
{
    const CHARGE_TYPE_SHA = 'SHA';
    const CHARGE_TYPE_OUR = 'OUR';
    const URGENCY_STANDARD = 'standard';
    const URGENCY_URGENT = 'urgent';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return new Money($this->get('amount')['amount'], $this->get('amount')['currency']);
    }
    /**
     * @param Money $amount
     * @return $this
     */
    public function setAmount(Money $amount)
    {
        $this->set('amount', ['amount' => $amount->getAmount(), 'currency' => $amount->getCurrency()]);
        return $this;
    }
    /**
     * @return TransferBeneficiary
     */
    public function getBeneficiary()
    {
        return (new TransferBeneficiary())->setDataByReference($this->getByReference('beneficiary'));
    }
    /**
     * @param TransferBeneficiary $beneficiary
     * @return $this
     */
    public function setBeneficiary(TransferBeneficiary $beneficiary)
    {
        $this->setByReference('beneficiary', $beneficiary->getDataByReference());
        return $this;
    }
    /**
     * @return Payer
     */
    public function getPayer()
    {
        return (new Payer())->setDataByReference($this->getByReference('payer'));
    }
    /**
     * @param Payer $payer
     * @return $this
     */
    public function setPayer(Payer $payer)
    {
        $this->setByReference('payer', $payer->getDataByReference());
        return $this;
    }
    /**
     * @return FinalBeneficiary|null
     */
    public function getFinalBeneficiary()
    {
        if ($this->get('final_beneficiary') === null) {
            return null;
        }
        return (new FinalBeneficiary())->setDataByReference($this->getByReference('final_beneficiary'));
    }
    /**
     * @param FinalBeneficiary $finalBeneficiary
     * @return $this
     */
    public function setFinalBeneficiary(FinalBeneficiary $finalBeneficiary)
    {
        $this->setByReference('final_beneficiary', $finalBeneficiary->getDataByReference());
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getPerformAt()
    {
        if ($this->get('perform_at') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('perform_at'));
    }
    /**
     * @param \DateTimeInterface $performAt
     * @return $this
     */
    public function setPerformAt(\DateTimeInterface $performAt)
    {
        $this->set('perform_at', $performAt->getTimestamp());
        return $this;
    }
    /**
     * @return string|null
     */
    public function getChargeType()
    {
        return $this->get('charge_type');
    }
    /**
     * @param string $chargeType
     * @return $this
     */
    public function setChargeType($chargeType)
    {
        $this->set('charge_type', $chargeType);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getUrgency()
    {
        return $this->get('urgency');
    }
    /**
     * @param string $urgency
     * @return $this
     */
    public function setUrgency($urgency)
    {
        $this->set('urgency', $urgency);
        return $this;
    }
    /**
     * @return TransferNotifications|null
     */
    public function getNotifications()
    {
        if ($this->get('notifications') === null) {
            return null;
        }
        return (new TransferNotifications())->setDataByReference($this->getByReference('notifications'));
    }
    /**
     * @param TransferNotifications $notifications
     * @return $this
     */
    public function setNotifications(TransferNotifications $notifications)
    {
        $this->setByReference('notifications', $notifications->getDataByReference());
        return $this;
    }
    /**
     * @return TransferPurpose
     */
    public function getPurpose()
    {
        return (new TransferPurpose())->setDataByReference($this->getByReference('purpose'));
    }
    /**
     * @param TransferPurpose $purpose
     * @return $this
     */
    public function setPurpose(TransferPurpose $purpose)
    {
        $this->setByReference('purpose', $purpose->getDataByReference());
        return $this;
    }
    /**
     * @return TransferPassword34|null
     */
    public function getPassword()
    {
        if ($this->get('password') === null) {
            return null;
        }
        return (new TransferPassword34())->setDataByReference($this->getByReference('password'));
    }
    /**
     * @param TransferPassword34 $password
     * @return $this
     */
    public function setPassword(TransferPassword34 $password)
    {
        $this->setByReference('password', $password->getDataByReference());
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isCancelable()
    {
        return $this->get('cancelable');
    }
    /**
     * @param boolean $cancelable
     * @return $this
     */
    public function setCancelable($cancelable)
    {
        $this->set('cancelable', $cancelable);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAutoCurrencyConvert()
    {
        return $this->get('auto_currency_convert');
    }
    /**
     * @param boolean $autoCurrencyConvert
     * @return $this
     */
    public function setAutoCurrencyConvert($autoCurrencyConvert)
    {
        $this->set('auto_currency_convert', $autoCurrencyConvert);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAutoChargeRelatedCard()
    {
        return $this->get('auto_charge_related_card');
    }
    /**
     * @param boolean $autoChargeRelatedCard
     * @return $this
     */
    public function setAutoChargeRelatedCard($autoChargeRelatedCard)
    {
        $this->set('auto_charge_related_card', $autoChargeRelatedCard);
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getReserveUntil()
    {
        if ($this->get('reserve_until') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('reserve_until'));
    }
    /**
     * @param \DateTimeInterface $reserveUntil
     * @return $this
     */
    public function setReserveUntil(\DateTimeInterface $reserveUntil)
    {
        $this->set('reserve_until', $reserveUntil->getTimestamp());
        return $this;
    }
}
