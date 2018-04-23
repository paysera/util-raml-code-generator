import { Entity } from 'paysera-http-client-common';

import TransferInitiator from '../entity/TransferInitiator';
import TransferFailureStatus from '../entity/TransferFailureStatus';
import Money from '../entity/Money';
import TransferAdditionalData from '../entity/TransferAdditionalData';
import DateFactory from '../service/DateFactory';

class TransferOutput extends Entity {
    constructor(data = []) {
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
        this.set('initiator', initiator.data);
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
        return new TransferFailureStatus(this.get('failure_status'));
    }

    /**
     * @param {TransferFailureStatus} failureStatus
     */
    setFailureStatus(failureStatus) {
        this.set('failure_status', failureStatus.data);
    }

    /**
     * @return {Money}|null
     */
    getOutCommission() {
        return new Money(this.get('out_commission'));
    }

    /**
     * @param {Money} outCommission
     */
    setOutCommission(outCommission) {
        this.set('out_commission', outCommission.data);
    }

    /**
     * @return {TransferAdditionalData}|null
     */
    getAdditionalInformation() {
        return new TransferAdditionalData(this.get('additional_information'));
    }

    /**
     * @param {TransferAdditionalData} additionalInformation
     */
    setAdditionalInformation(additionalInformation) {
        this.set('additional_information', additionalInformation.data);
    }
}

export default TransferOutput;
