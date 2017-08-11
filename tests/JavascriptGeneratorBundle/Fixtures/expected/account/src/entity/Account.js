import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class Account extends Entity {

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
}

export default Account;
