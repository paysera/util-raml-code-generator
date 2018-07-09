import { Entity } from '@paysera/http-client-common';

import DateFactory from '../service/DateFactory';

class TaxAccount extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getIdentifier() {
        return this.get('identifier');
    }

    /**
     * @param {string} identifier
     */
    setIdentifier(identifier) {
        this.set('identifier', identifier);
    }
}

export default TaxAccount;
