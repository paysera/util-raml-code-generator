import { Entity } from '@paysera/http-client-common';

class Identifiers extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string|null}
     */
    getGeneral() {
        return this.get('general');
    }

    /**
     * @param {string} general
     */
    setGeneral(general) {
        this.set('general', general);
    }

    /**
     * @return {string|null}
     */
    getPersonalCode() {
        return this.get('personal_code');
    }

    /**
     * @param {string} personalCode
     */
    setPersonalCode(personalCode) {
        this.set('personal_code', personalCode);
    }

    /**
     * @return {string|null}
     */
    getLegalCode() {
        return this.get('legal_code');
    }

    /**
     * @param {string} legalCode
     */
    setLegalCode(legalCode) {
        this.set('legal_code', legalCode);
    }

    /**
     * @return {string|null}
     */
    getTaxCode() {
        return this.get('tax_code');
    }

    /**
     * @param {string} taxCode
     */
    setTaxCode(taxCode) {
        this.set('tax_code', taxCode);
    }

    /**
     * @return {string|null}
     */
    getKppCode() {
        return this.get('kpp_code');
    }

    /**
     * @param {string} kppCode
     */
    setKppCode(kppCode) {
        this.set('kpp_code', kppCode);
    }
}

export default Identifiers;
