<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Evp\Component\Money\Money;

class TransferAdditionalData
{
    private $id;
    private $estimatedProcessingDate;
    private $outCommissionRule;
    private $originalOutCommissionAmount;
    private $originalOutCommissionCurrency;
    private $correspondentBankFeesMayApply;

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
     * @return \DateTime|null
     */
    public function getEstimatedProcessingDate()
    {
        return $this->estimatedProcessingDate;
    }
    /**
     * @param \DateTimeInterface $estimatedProcessingDate
     * @return $this
     */
    public function setEstimatedProcessingDate(\DateTimeInterface $estimatedProcessingDate)
    {
        $this->estimatedProcessingDate = $estimatedProcessingDate;
        return $this;
    }
    /**
     * @return OutCommissionRule|null
     */
    public function getOutCommissionRule()
    {
        return $this->outCommissionRule;
    }
    /**
     * @param OutCommissionRule $outCommissionRule
     * @return $this
     */
    public function setOutCommissionRule(OutCommissionRule $outCommissionRule)
    {
        $this->outCommissionRule = $outCommissionRule;
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getOriginalOutCommission()
    {
        if ($this->originalOutCommissionAmount === null && $this->originalOutCommissionCurrency === null) {
            return null;
        }
        return new Money($this->originalOutCommissionAmount, $this->originalOutCommissionCurrency);
    }
    /**
     * @param Money $originalOutCommission
     * @return $this
     */
    public function setOriginalOutCommission(Money $originalOutCommission)
    {
        $this->originalOutCommissionAmount = $originalOutCommission->getAmount();
        $this->originalOutCommissionCurrency = $originalOutCommission->getCurrency();
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isCorrespondentBankFeesMayApply()
    {
        return $this->correspondentBankFeesMayApply;
    }
    /**
     * @param boolean $correspondentBankFeesMayApply
     * @return $this
     */
    public function setCorrespondentBankFeesMayApply($correspondentBankFeesMayApply)
    {
        $this->correspondentBankFeesMayApply = $correspondentBankFeesMayApply;
        return $this;
    }

}
