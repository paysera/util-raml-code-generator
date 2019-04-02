import Address from './Address';
import CorrespondentBank from './CorrespondentBank';
import { Entity } from '@paysera/http-client-common';

class BankAccount extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string|null}
     */
    getIban() {
        return this.get('iban');
    }

    /**
     * @param {string} iban
     */
    setIban(iban) {
        this.set('iban', iban);
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
     * @return {string|null}
     */
    getBic() {
        return this.get('bic');
    }

    /**
     * @param {string} bic
     */
    setBic(bic) {
        this.set('bic', bic);
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

    /**
     * @return {Address|null}
     */
    getBankAddress() {
        if (this.get('bank_address') == null) {
            return null;
        }
        return new Address(this.get('bank_address'));
    }

    /**
     * @param {Address} bankAddress
     */
    setBankAddress(bankAddress) {
        this.set('bank_address', bankAddress.getData());
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
     * @return {CorrespondentBank|null}
     */
    getCorrespondentBank() {
        if (this.get('correspondent_bank') == null) {
            return null;
        }
        return new CorrespondentBank(this.get('correspondent_bank'));
    }

    /**
     * @param {CorrespondentBank} correspondentBank
     */
    setCorrespondentBank(correspondentBank) {
        this.set('correspondent_bank', correspondentBank.getData());
    }
}

export default BankAccount;
