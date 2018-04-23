import { Entity } from 'paysera-http-client-common';

import OutCommissionRule from '../entity/OutCommissionRule';
import Money from '../entity/Money';
import DateFactory from '../service/DateFactory';

class TransferAdditionalData extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {Date}|null
     */
    getEstimatedProcessingDate() {
        return DateFactory.create(this.get('estimated_processing_date'));
    }

    /**
     * @param {Date} estimatedProcessingDate
     */
    setEstimatedProcessingDate(estimatedProcessingDate) {
        this.set('estimated_processing_date', estimatedProcessingDate.getTime());
    }

    /**
     * @return {OutCommissionRule}|null
     */
    getOutCommissionRule() {
        return new OutCommissionRule(this.get('out_commission_rule'));
    }

    /**
     * @param {OutCommissionRule} outCommissionRule
     */
    setOutCommissionRule(outCommissionRule) {
        this.set('out_commission_rule', outCommissionRule.data);
    }

    /**
     * @return {Money}|null
     */
    getOriginalOutCommission() {
        return new Money(this.get('original_out_commission'));
    }

    /**
     * @param {Money} originalOutCommission
     */
    setOriginalOutCommission(originalOutCommission) {
        this.set('original_out_commission', originalOutCommission.data);
    }

    /**
     * @return {boolean}|null
     */
    isCorrespondentBankFeesMayApply() {
        return this.get('correspondent_bank_fees_may_apply');
    }

    /**
     * @param {boolean} correspondentBankFeesMayApply
     */
    setCorrespondentBankFeesMayApply(correspondentBankFeesMayApply) {
        this.set('correspondent_bank_fees_may_apply', correspondentBankFeesMayApply);
    }
}

export default TransferAdditionalData;
