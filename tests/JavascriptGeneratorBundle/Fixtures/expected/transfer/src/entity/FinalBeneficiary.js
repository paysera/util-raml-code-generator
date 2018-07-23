import Identifiers from './Identifiers';
import { Entity } from '@paysera/http-client-common';

class FinalBeneficiary extends Entity {
    constructor(data = {}) {
        super(data);
    }

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
        if (this.get('identifiers') == null) {
            return null;
        }
        return new Identifiers(this.get('identifiers'));
    }

    /**
     * @param {Identifiers} identifiers
     */
    setIdentifiers(identifiers) {
        this.set('identifiers', identifiers.getData());
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
