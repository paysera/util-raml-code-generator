import { Entity } from '@paysera/http-client-common';

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
