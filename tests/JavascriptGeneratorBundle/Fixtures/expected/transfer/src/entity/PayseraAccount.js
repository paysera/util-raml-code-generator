import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class PayseraAccount extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getAccountNumber() {
        return this.get('account_number');
    }

    /**
     * @param {string} accountNumber
     */
    setAccountNumber(accountNumber) {
        this.set('account_number', accountNumber);
    }

    /**
     * @return {string}|null
     */
    getEmail() {
        return this.get('email');
    }

    /**
     * @param {string} email
     */
    setEmail(email) {
        this.set('email', email);
    }

    /**
     * @return {string}|null
     */
    getPhone() {
        return this.get('phone');
    }

    /**
     * @param {string} phone
     */
    setPhone(phone) {
        this.set('phone', phone);
    }
}

export default PayseraAccount;
