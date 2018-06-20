import { Money } from '@paysera/money';
import TransferAdditionalData from './TransferAdditionalData';
import TransferFailureStatus from './TransferFailureStatus';
import TransferInitiator from './TransferInitiator';
import TransferInput from './TransferInput';

import DateFactory from '../service/DateFactory';

class TransferOutput extends TransferInput {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getId() {
        return this.get('id');
    }

    /**
     * @param {string} id
     */
    setId(id) {
        this.set('id', id);
    }

    /**
     * @return {string}
     */
    getStatus() {
        return this.get('status');
    }

    /**
     * @param {string} status
     */
    setStatus(status) {
        this.set('status', status);
    }

    /**
     * @return {TransferInitiator}
     */
    getInitiator() {
        return new TransferInitiator(this.get('initiator'));
    }

    /**
     * @param {TransferInitiator} initiator
     */
    setInitiator(initiator) {
        this.set('initiator', initiator.getData());
    }

    /**
     * @return {Date}
     */
    getCreatedAt() {
        return DateFactory.create(this.get('created_at'));
    }

    /**
     * @param {Date} createdAt
     */
    setCreatedAt(createdAt) {
        this.set('created_at', createdAt.getTime());
    }

    /**
     * @return {Date}|null
     */
    getPerformedAt() {
        if (this.get('performed_at') == null) {
            return null;
        }
        return DateFactory.create(this.get('performed_at'));
    }

    /**
     * @param {Date} performedAt
     */
    setPerformedAt(performedAt) {
        this.set('performed_at', performedAt.getTime());
    }

    /**
     * @return {TransferFailureStatus}|null
     */
    getFailureStatus() {
        if (this.get('failure_status') == null) {
            return null;
        }
        return new TransferFailureStatus(this.get('failure_status'));
    }

    /**
     * @param {TransferFailureStatus} failureStatus
     */
    setFailureStatus(failureStatus) {
        this.set('failure_status', failureStatus.getData());
    }

    /**
     * @return {Money}|null
     */
    getOutCommission() {
        if (this.get('out_commission')['amount'] == null && this.get('out_commission')['currency'] == null) {
            return null;
        }
        return new Money(this.get('out_commission')['amount'], this.get('out_commission')['currency']);
    }

    /**
     * @param {Money} outCommission
     */
    setOutCommission(outCommission) {
        this.set('out_commission', {'amount':outCommission.getAmount(), 'currency':outCommission.getCurrency()});
    }

    /**
     * @return {TransferAdditionalData}|null
     */
    getAdditionalInformation() {
        if (this.get('additional_information') == null) {
            return null;
        }
        return new TransferAdditionalData(this.get('additional_information'));
    }

    /**
     * @param {TransferAdditionalData} additionalInformation
     */
    setAdditionalInformation(additionalInformation) {
        this.set('additional_information', additionalInformation.getData());
    }
}

export default TransferOutput;
