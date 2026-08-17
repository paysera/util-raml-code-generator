import PaymentMetadata from './PaymentMetadata';
import SearchResultMetadata from './SearchResultMetadata';
import { Entity } from '@paysera/http-client-common';

class Payment extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getId() {
        return this.get('id');
    }

    /**
     * @param {string} id
     */
    setId(id) {
        this.set('id', id);
    }

    /**
     * @return {string}
     */
    getCurrency() {
        return this.get('currency');
    }

    /**
     * @param {string} currency
     */
    setCurrency(currency) {
        this.set('currency', currency);
    }

    /**
     * @return {Array.<string>|null}
     */
    getAllowedCurrencies() {
        return this.get('allowed_currencies');
    }

    /**
     * @param {Array.<string>} allowedCurrencies
     */
    setAllowedCurrencies(allowedCurrencies) {
        this.set('allowed_currencies', allowedCurrencies);
    }

    /**
     * @return {string}
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
    getScanResult() {
        return this.get('scan_result');
    }

    /**
     * @param {string} scanResult
     */
    setScanResult(scanResult) {
        this.set('scan_result', scanResult);
    }

    /**
     * @return {string|null}
     */
    getFilterMode() {
        return this.get('filter_mode');
    }

    /**
     * @param {string} filterMode
     */
    setFilterMode(filterMode) {
        this.set('filter_mode', filterMode);
    }

    /**
     * @return {PaymentMetadata|null}
     */
    getMetadata() {
        if (this.get('metadata') == null) {
            return null;
        }
        return new PaymentMetadata(this.get('metadata'));
    }

    /**
     * @param {PaymentMetadata} metadata
     */
    setMetadata(metadata) {
        this.set('metadata', metadata.getData());
    }

    /**
     * @return {SearchResultMetadata|null}
     */
    getSearchMetadata() {
        if (this.get('search_metadata') == null) {
            return null;
        }
        return new SearchResultMetadata(this.get('search_metadata'));
    }

    /**
     * @param {SearchResultMetadata} searchMetadata
     */
    setSearchMetadata(searchMetadata) {
        this.set('search_metadata', searchMetadata.getData());
    }
}

Payment.currencies = {
    CURRENCY_EUR: 'EUR',
    CURRENCY_USD: 'USD',
};

Payment.allowedCurrencies = {
    ALLOWED_CURRENCIES_EUR: 'EUR',
    ALLOWED_CURRENCIES_USD: 'USD',
};

Payment.scanResults = {
    SCAN_RESULT_CLEAN: 'clean',
    SCAN_RESULT_FLAGGED: 'flagged',
};

Payment.filterModes = {
    FILTER_MODE_STRICT: 'strict',
    FILTER_MODE_LOOSE: 'loose',
};

export default Payment;
