import User from './User';

import DateFactory from '../service/DateFactory';

class UserLegal extends User {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getCompanyName() {
        return this.get('company_name');
    }

    /**
     * @param {string} companyName
     */
    setCompanyName(companyName) {
        this.set('company_name', companyName);
    }

    /**
     * @return {string}
     */
    getCompanyCode() {
        return this.get('company_code');
    }

    /**
     * @param {string} companyCode
     */
    setCompanyCode(companyCode) {
        this.set('company_code', companyCode);
    }

    /**
     * @return {string}|null
     */
    getVatCode() {
        return this.get('vat_code');
    }

    /**
     * @param {string} vatCode
     */
    setVatCode(vatCode) {
        this.set('vat_code', vatCode);
    }
}

export default UserLegal;
