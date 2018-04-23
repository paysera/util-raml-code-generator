import { Entity } from 'paysera-http-client-common';

import Identifiers from '../entity/Identifiers';
import BankAccount from '../entity/BankAccount';
import TaxAccount from '../entity/TaxAccount';
import PayseraAccount from '../entity/PayseraAccount';
import PayzaAccount from '../entity/PayzaAccount';
import WebmoneyAccount from '../entity/WebmoneyAccount';
import DateFactory from '../service/DateFactory';

class TransferBeneficiary extends Entity {
    constructor(data = []) {
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

    /**
     * @return {BankAccount}|null
     */
    getBankAccount() {
        return new BankAccount(this.get('bank_account'));
    }

    /**
     * @param {BankAccount} bankAccount
     */
    setBankAccount(bankAccount) {
        this.set('bank_account', bankAccount.data);
    }

    /**
     * @return {TaxAccount}|null
     */
    getTaxAccount() {
        return new TaxAccount(this.get('tax_account'));
    }

    /**
     * @param {TaxAccount} taxAccount
     */
    setTaxAccount(taxAccount) {
        this.set('tax_account', taxAccount.data);
    }

    /**
     * @return {PayseraAccount}|null
     */
    getPayseraAccount() {
        return new PayseraAccount(this.get('paysera_account'));
    }

    /**
     * @param {PayseraAccount} payseraAccount
     */
    setPayseraAccount(payseraAccount) {
        this.set('paysera_account', payseraAccount.data);
    }

    /**
     * @return {PayzaAccount}|null
     */
    getPayzaAccount() {
        return new PayzaAccount(this.get('payza_account'));
    }

    /**
     * @param {PayzaAccount} payzaAccount
     */
    setPayzaAccount(payzaAccount) {
        this.set('payza_account', payzaAccount.data);
    }

    /**
     * @return {WebmoneyAccount}|null
     */
    getWebmoneyAccount() {
        return new WebmoneyAccount(this.get('webmoney_account'));
    }

    /**
     * @param {WebmoneyAccount} webmoneyAccount
     */
    setWebmoneyAccount(webmoneyAccount) {
        this.set('webmoney_account', webmoneyAccount.data);
    }
}

export default TransferBeneficiary;
