import { Entity } from '@paysera/http-client-common';

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
