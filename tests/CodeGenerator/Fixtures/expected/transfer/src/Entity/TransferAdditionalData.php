<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferAdditionalData extends Entity
{
    /**
     * @return \DateTimeImmutable|null
     */
    public function getEstimatedProcessingDate()
    {
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
        return (new Money())->setDataByReference($this->getByReference('original_out_commission'));
    }
    /**
     * @param Money $originalOutCommission
     * @return $this
     */
    public function setOriginalOutCommission(Money $originalOutCommission)
    {
        $this->setByReference('original_out_commission', $originalOutCommission->getDataByReference());
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
