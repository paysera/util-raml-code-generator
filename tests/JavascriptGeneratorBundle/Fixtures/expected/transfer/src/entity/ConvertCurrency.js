import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class ConvertCurrency extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getFromCurrency() {
        return this.get('from_currency');
    }

    /**
     * @param {string} fromCurrency
     */
    setFromCurrency(fromCurrency) {
        this.set('from_currency', fromCurrency);
    }

    /**
     * @return {string}
     */
    getToCurrency() {
        return this.get('to_currency');
    }

    /**
     * @param {string} toCurrency
     */
    setToCurrency(toCurrency) {
        this.set('to_currency', toCurrency);
    }

    /**
     * @return {string}|null
     */
    getToAmount() {
        return this.get('to_amount');
    }

    /**
     * @param {string} toAmount
     */
    setToAmount(toAmount) {
        this.set('to_amount', toAmount);
    }

    /**
     * @return {string}|null
     */
    getFromAmount() {
        return this.get('from_amount');
    }

    /**
     * @param {string} fromAmount
     */
    setFromAmount(fromAmount) {
        this.set('from_amount', fromAmount);
    }

    /**
     * @return {string}|null
     */
    getMinToAmount() {
        return this.get('min_to_amount');
    }

    /**
     * @param {string} minToAmount
     */
    setMinToAmount(minToAmount) {
        this.set('min_to_amount', minToAmount);
    }

    /**
     * @return {string}|null
     */
    getMaxFromAmount() {
        return this.get('max_from_amount');
    }

    /**
     * @param {string} maxFromAmount
     */
    setMaxFromAmount(maxFromAmount) {
        this.set('max_from_amount', maxFromAmount);
    }

    /**
     * @return {string}|null
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
}

export default ConvertCurrency;
