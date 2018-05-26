import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferPassword34 extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
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
     * @return {string}
     */
    getValue() {
        return this.get('value');
    }

    /**
     * @param {string} value
     */
    setValue(value) {
        this.set('value', value);
    }
}

export default TransferPassword34;
