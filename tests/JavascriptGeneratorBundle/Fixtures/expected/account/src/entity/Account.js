import UndescribedType from './UndescribedType';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

class Account extends Entity {
    constructor(data = {}) {
        super(data);
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
     * @return {string}
     */
    getNumber() {
        return this.get('number');
    }

    /**
     * @param {string} number
     */
    setNumber(number) {
        this.set('number', number);
    }

    /**
     * @return {boolean}
     */
    isActive() {
        return this.get('active');
    }

    /**
     * @param {boolean} active
     */
    setActive(active) {
        this.set('active', active);
    }

    /**
     * @return {Number}
     */
    getClientId() {
        return this.get('client_id');
    }

    /**
     * @param {Number} clientId
     */
    setClientId(clientId) {
        this.set('client_id', clientId);
    }

    /**
     * @return {boolean}
     */
    isClosed() {
        return this.get('closed');
    }

    /**
     * @param {boolean} closed
     */
    setClosed(closed) {
        this.set('closed', closed);
    }

    /**
     * @return {string}
     */
    getType() {
        return this.get('type');
    }

    /**
     * @param {string} type
     */
    setType(type) {
        this.set('type', type);
    }

    /**
     * @return {UndescribedType}
     */
    getUndescribed() {
        return new UndescribedType(this.get('undescribed'));
    }

    /**
     * @param {UndescribedType} undescribed
     */
    setUndescribed(undescribed) {
        this.set('undescribed', undescribed.getData());
    }
}

export default Account;
