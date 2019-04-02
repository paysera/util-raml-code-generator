import OutCommissionRule from './OutCommissionRule';
import { Money } from '@paysera/money';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

class TransferAdditionalData extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {DateTime|null}
     */
    getEstimatedProcessingDate() {
        if (this.get('estimated_processing_date') == null) {
            return null;
        }
        return DateTime.fromMillis(this.get('estimated_processing_date') * 1000);
    }

    /**
     * @param {DateTime} estimatedProcessingDate
     */
    setEstimatedProcessingDate(estimatedProcessingDate) {
        this.set('estimated_processing_date', Math.floor(estimatedProcessingDate.toMillis()/1000));
    }

    /**
     * @return {OutCommissionRule|null}
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
     * @return {Money|null}
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
     * @return {boolean|null}
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
