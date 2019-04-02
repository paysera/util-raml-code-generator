import { Entity } from '@paysera/http-client-common';

class CorrespondentBank extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string|null}
     */
    getBankTitle() {
        return this.get('bank_title');
    }

    /**
     * @param {string} bankTitle
     */
    setBankTitle(bankTitle) {
        this.set('bank_title', bankTitle);
    }

    /**
     * @return {string|null}
     */
    getAccountNumber() {
        return this.get('account_number');
    }

    /**
     * @param {string} accountNumber
     */
    setAccountNumber(accountNumber) {
        this.set('account_number', accountNumber);
    }

    /**
     * @return {string|null}
     */
    getBankCode() {
        return this.get('bank_code');
    }

    /**
     * @param {string} bankCode
     */
    setBankCode(bankCode) {
        this.set('bank_code', bankCode);
    }
}

export default CorrespondentBank;
