import { Money } from '@paysera/money';
import TransferAdditionalData from './TransferAdditionalData';
import TransferFailureStatus from './TransferFailureStatus';
import TransferInitiator from './TransferInitiator';
import TransferInput from './TransferInput';
import { DateTime } from 'luxon';

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
     * @return {DateTime}
     */
    getCreatedAt() {
        return DateTime.fromMillis(this.get('created_at') * 1000);
    }

    /**
     * @param {DateTime} createdAt
     */
    setCreatedAt(createdAt) {
        this.set('created_at', Math.floor(createdAt.toMillis()/1000));
    }

    /**
     * @return {DateTime|null}
     */
    getPerformedAt() {
        if (this.get('performed_at') == null) {
            return null;
        }
        return DateTime.fromMillis(this.get('performed_at') * 1000);
    }

    /**
     * @param {DateTime} performedAt
     */
    setPerformedAt(performedAt) {
        this.set('performed_at', Math.floor(performedAt.toMillis()/1000));
    }

    /**
     * @return {TransferFailureStatus|null}
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
     * @return {Money|null}
     */
    getOutCommission() {
        if (this.get('out_commission')['amount'] === null || this.get('out_commission')['currency'] === null) {
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
     * @return {TransferAdditionalData|null}
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

TransferOutput.statuses = {
    STATUS_NEW: 'new',
    STATUS_REGISTERED: 'registered',
    STATUS_WAITING_FUNDS: 'waiting_funds',
    STATUS_WAITING_REGISTRATION: 'waiting_registration',
    STATUS_WAITING_PASSWORD: 'waiting_password',
    STATUS_RESERVED: 'reserved',
    STATUS_FROZEN: 'frozen',
    STATUS_PROCESSING: 'processing',
    STATUS_DONE: 'done',
    STATUS_REJECTED: 'rejected',
    STATUS_REVOKED: 'revoked',
    STATUS_FAILED: 'failed',
};

export default TransferOutput;
