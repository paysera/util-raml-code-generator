import OutCommissionRule from './OutCommissionRule';
import { Money } from '@paysera/money';
import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferAdditionalData extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {Date}|null
     */
    getEstimatedProcessingDate() {
        if (this.get('estimated_processing_date') == null) {
            return null;
        }
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
        if (this.get('out_commission_rule') == null) {
            return null;
        }
        return new OutCommissionRule(this.get('out_commission_rule'));
    }

    /**
     * @param {OutCommissionRule} outCommissionRule
     */
    setOutCommissionRule(outCommissionRule) {
        this.set('out_commission_rule', outCommissionRule.getData());
    }

    /**
     * @return {Money}|null
     */
    getOriginalOutCommission() {
        if (this.get('original_out_commission')['amount'] === null || this.get('original_out_commission')['currency'] === null) {
            return null;
        }
        return new Money(this.get('original_out_commission')['amount'], this.get('original_out_commission')['currency']);
    }

    /**
     * @param {Money} originalOutCommission
     */
    setOriginalOutCommission(originalOutCommission) {
        this.set('original_out_commission', {'amount':originalOutCommission.getAmount(), 'currency':originalOutCommission.getCurrency()});
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
