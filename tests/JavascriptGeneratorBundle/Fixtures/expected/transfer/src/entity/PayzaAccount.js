import { Entity } from '@paysera/http-client-common';

class PayzaAccount extends Entity {
    constructor(data = {}) {
        super(data);
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

export default PayzaAccount;
