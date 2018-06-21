<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

use Evp\Component\Money\Money;

use Doctrine\Common\Collections\ArrayCollection;

class Whitelist
{
    private $id;
    private $payerCovenanteeId;
    private $payerAccountIdentifier;
    private $beneficiaryCovenanteeId;
    private $beneficiaryAccountIdentifier;
    private $maxAmountAmount;
    private $maxAmountCurrency;
    private $profiles;

    public function __construct()
    {
                                
        $this->profiles = new ArrayCollection();
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
    public function getPayerCovenanteeId()
    {
        return $this->payerCovenanteeId;
    }
    /**
     * @param string $payerCovenanteeId
     * @return $this
     */
    public function setPayerCovenanteeId($payerCovenanteeId)
    {
        $this->payerCovenanteeId = $payerCovenanteeId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPayerAccountIdentifier()
    {
        return $this->payerAccountIdentifier;
    }
    /**
     * @param string $payerAccountIdentifier
     * @return $this
     */
    public function setPayerAccountIdentifier($payerAccountIdentifier)
    {
        $this->payerAccountIdentifier = $payerAccountIdentifier;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBeneficiaryCovenanteeId()
    {
        return $this->beneficiaryCovenanteeId;
    }
    /**
     * @param string $beneficiaryCovenanteeId
     * @return $this
     */
    public function setBeneficiaryCovenanteeId($beneficiaryCovenanteeId)
    {
        $this->beneficiaryCovenanteeId = $beneficiaryCovenanteeId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBeneficiaryAccountIdentifier()
    {
        return $this->beneficiaryAccountIdentifier;
    }
    /**
     * @param string $beneficiaryAccountIdentifier
     * @return $this
     */
    public function setBeneficiaryAccountIdentifier($beneficiaryAccountIdentifier)
    {
        $this->beneficiaryAccountIdentifier = $beneficiaryAccountIdentifier;
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMaxAmount()
    {
        if ($this->maxAmountAmount === null && $this->maxAmountCurrency === null) {
            return null;
        }
        return new Money($this->maxAmountAmount, $this->maxAmountCurrency);
    }
    /**
     * @param Money $maxAmount
     * @return $this
     */
    public function setMaxAmount(Money $maxAmount)
    {
        $this->maxAmountAmount = $maxAmount->getAmount();
        $this->maxAmountCurrency = $maxAmount->getCurrency();
        return $this;
    }
    /**
     * @return WhitelistProfile[]|ArrayCollection
     */
    public function getProfiles()
    {
        return $this->profiles;
    }
        /**
     * @param WhitelistProfile[] $profiles
     * @return $this
     */
    public function setProfiles(array $profiles)
    {
        foreach($this->profiles as $item) {
            $this->removeProfile($item);
        }
        foreach($profiles as $item) {
            $this->addProfile($item);
        }
        return $this;
    }
    /**
     * @param WhitelistProfile $profile
     * @return $this
     */
    public function addProfile($profile)
    {
        if(!$this->profiles->contains($profile)) {
            $this->profiles->add($profile);
        }
        return $this;
    }
    /**
     * @param WhitelistProfile $profile
     * @return $this
     */
    public function removeProfile($profile)
    {
        $this->profiles->removeElement($profile);
        return $this;
    }
    
}
