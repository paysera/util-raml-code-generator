import BankAccount from './BankAccount';
import Identifiers from './Identifiers';
import PayseraAccount from './PayseraAccount';
import PayzaAccount from './PayzaAccount';
import TaxAccount from './TaxAccount';
import WebmoneyAccount from './WebmoneyAccount';
import { Entity } from '@paysera/http-client-common';

class TransferBeneficiary extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getType() {
        return this.get('type');
    }

    /**
     * @param {string} type
     */
    setType(type) {
        this.set('type', type);
    }

    /**
     * @return {Identifiers|null}
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
     * @return {string}
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
     * @return {string|null}
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

    /**
     * @return {BankAccount|null}
     */
    getBankAccount() {
        if (this.get('bank_account') == null) {
            return null;
        }
        return new BankAccount(this.get('bank_account'));
    }

    /**
     * @param {BankAccount} bankAccount
     */
    setBankAccount(bankAccount) {
        this.set('bank_account', bankAccount.getData());
    }

    /**
     * @return {TaxAccount|null}
     */
    getTaxAccount() {
        if (this.get('tax_account') == null) {
            return null;
        }
        return new TaxAccount(this.get('tax_account'));
    }

    /**
     * @param {TaxAccount} taxAccount
     */
    setTaxAccount(taxAccount) {
        this.set('tax_account', taxAccount.getData());
    }

    /**
     * @return {PayseraAccount|null}
     */
    getPayseraAccount() {
        if (this.get('paysera_account') == null) {
            return null;
        }
        return new PayseraAccount(this.get('paysera_account'));
    }

    /**
     * @param {PayseraAccount} payseraAccount
     */
    setPayseraAccount(payseraAccount) {
        this.set('paysera_account', payseraAccount.getData());
    }

    /**
     * @return {PayzaAccount|null}
     */
    getPayzaAccount() {
        if (this.get('payza_account') == null) {
            return null;
        }
        return new PayzaAccount(this.get('payza_account'));
    }

    /**
     * @param {PayzaAccount} payzaAccount
     */
    setPayzaAccount(payzaAccount) {
        this.set('payza_account', payzaAccount.getData());
    }

    /**
     * @return {WebmoneyAccount|null}
     */
    getWebmoneyAccount() {
        if (this.get('webmoney_account') == null) {
            return null;
        }
        return new WebmoneyAccount(this.get('webmoney_account'));
    }

    /**
     * @param {WebmoneyAccount} webmoneyAccount
     */
    setWebmoneyAccount(webmoneyAccount) {
        this.set('webmoney_account', webmoneyAccount.getData());
    }
}

TransferBeneficiary.types = {
    TYPE_PAYSERA: 'paysera',
    TYPE_PAYZA: 'payza',
    TYPE_WEBMONEY: 'webmoney',
    TYPE_TAX: 'tax',
    TYPE_BANK: 'bank',
};

TransferBeneficiary.personTypes = {
    PERSON_TYPE_NATURAL: 'natural',
    PERSON_TYPE_LEGAL: 'legal',
};

export default TransferBeneficiary;
