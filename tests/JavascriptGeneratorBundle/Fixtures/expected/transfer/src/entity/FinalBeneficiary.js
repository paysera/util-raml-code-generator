import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class FinalBeneficiary extends Entity {

    /**
     * @return {string}|null
     */
    getName() {
        return this.get('name');
    }

    /**
     * @param {string} name
     */
    setName(name) {
        this.set('name', name);
    }

    /**
     * @return {Identifiers}|null
     */
    getIdentifiers() {
        return new Identifiers(this.get('identifiers'));
    }

    /**
     * @param {Identifiers} identifiers
     */
    setIdentifiers(identifiers) {
        this.set('identifiers', identifiers.data);
    }

    /**
     * @return {string}|null
     */
    getPersonType() {
        return this.get('person_type');
    }

    /**
     * @param {string} personType
     */
    setPersonType(personType) {
        this.set('person_type', personType);
    }
}

export default FinalBeneficiary;
