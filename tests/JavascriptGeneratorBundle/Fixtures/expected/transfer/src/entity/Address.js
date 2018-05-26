import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class Address extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getCountryCode() {
        return this.get('country_code');
    }

    /**
     * @param {string} countryCode
     */
    setCountryCode(countryCode) {
        this.set('country_code', countryCode);
    }

    /**
     * @return {string}|null
     */
    getAddressLine() {
        return this.get('address_line');
    }

    /**
     * @param {string} addressLine
     */
    setAddressLine(addressLine) {
        this.set('address_line', addressLine);
    }
}

export default Address;
