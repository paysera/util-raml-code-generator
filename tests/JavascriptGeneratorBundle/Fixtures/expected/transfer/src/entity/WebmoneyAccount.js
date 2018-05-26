import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class WebmoneyAccount extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getPurse() {
        return this.get('purse');
    }

    /**
     * @param {string} purse
     */
    setPurse(purse) {
        this.set('purse', purse);
    }
}

export default WebmoneyAccount;
