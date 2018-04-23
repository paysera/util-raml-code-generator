import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferInitiator extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getUserId() {
        return this.get('user_id');
    }

    /**
     * @param {string} userId
     */
    setUserId(userId) {
        this.set('user_id', userId);
    }

    /**
     * @return {string}|null
     */
    getClientId() {
        return this.get('client_id');
    }

    /**
     * @param {string} clientId
     */
    setClientId(clientId) {
        this.set('client_id', clientId);
    }
}

export default TransferInitiator;
