import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class Money extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {string}
     */
    getAmount() {
        return this.get('amount');
    }

    /**
     * @param {string} amount
     */
    setAmount(amount) {
        this.set('amount', amount);
    }

    /**
     * @return {string}
     */
    getCurrency() {
        return this.get('currency');
    }

    /**
     * @param {string} currency
     */
    setCurrency(currency) {
        this.set('currency', currency);
    }
}

export default Money;
