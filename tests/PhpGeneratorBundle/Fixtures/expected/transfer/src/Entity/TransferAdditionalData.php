<?php

namespace Paysera\Test\TestClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferAdditionalData extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getEstimatedProcessingDate()
    {
        if ($this->get('estimated_processing_date') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('estimated_processing_date'));
    }
    /**
     * @param \DateTimeInterface $estimatedProcessingDate
     * @return $this
     */
    public function setEstimatedProcessingDate(\DateTimeInterface $estimatedProcessingDate)
    {
        $this->set('estimated_processing_date', $estimatedProcessingDate->getTimestamp());
        return $this;
    }
    /**
     * @return OutCommissionRule|null
     */
    public function getOutCommissionRule()
    {
        if ($this->get('out_commission_rule') === null) {
            return null;
        }
        return (new OutCommissionRule())->setDataByReference($this->getByReference('out_commission_rule'));
    }
    /**
     * @param OutCommissionRule $outCommissionRule
     * @return $this
     */
    public function setOutCommissionRule(OutCommissionRule $outCommissionRule)
    {
        $this->setByReference('out_commission_rule', $outCommissionRule->getDataByReference());
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getOriginalOutCommission()
    {
        if ($this->get('original_out_commission_amount') === null && $this->get('original_out_commission_currency') === null) {
            return null;
        }
        return new Money($this->get('original_out_commission_amount'), $this->get('original_out_commission_currency'));
    }
    /**
     * @param Money $originalOutCommission
     * @return $this
     */
    public function setOriginalOutCommission(Money $originalOutCommission)
    {
        $this->set('original_out_commission_amount', $originalOutCommission->getAmount());
        $this->set('original_out_commission_currency', $originalOutCommission->getCurrency());
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isCorrespondentBankFeesMayApply()
    {
        return $this->get('correspondent_bank_fees_may_apply');
    }
    /**
     * @param boolean $correspondentBankFeesMayApply
     * @return $this
     */
    public function setCorrespondentBankFeesMayApply($correspondentBankFeesMayApply)
    {
        $this->set('correspondent_bank_fees_may_apply', $correspondentBankFeesMayApply);
        return $this;
    }
}
