import { Entity } from '@paysera/http-client-common';

import DateFactory from '../service/DateFactory';

class TransferNotifcation extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getLocale() {
        return this.get('locale');
    }

    /**
     * @param {string} locale
     */
    setLocale(locale) {
        this.set('locale', locale);
    }

    /**
     * @return {string}
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
}

export default TransferNotifcation;
