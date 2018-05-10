import { Entity } from 'paysera-http-client-common';

class TransfersFilter extends Entity {
    /**
     * @return {Date}|null
     */
    getCreatedDateFrom() {
        if (this.get('created_date_from') == null) {
            return null;
        }
        return DateFactory.create(this.get('created_date_from'));
    }

    /**
     * @param {Date} createdDateFrom
     */
    setCreatedDateFrom(createdDateFrom) {
        this.set('created_date_from', createdDateFrom.getTime());
    }

    /**
     * @return {Date}|null
     */
    getCreatedDateTo() {
        if (this.get('created_date_to') == null) {
            return null;
        }
        return DateFactory.create(this.get('created_date_to'));
    }

    /**
     * @param {Date} createdDateTo
     */
    setCreatedDateTo(createdDateTo) {
        this.set('created_date_to', createdDateTo.getTime());
    }

    /**
     * @return {string}|null
     */
    getCreditAccountNumber() {
        return this.get('credit_account_number');
    }

    /**
     * @param {string} creditAccountNumber
     */
    setCreditAccountNumber(creditAccountNumber) {
        this.set('credit_account_number', creditAccountNumber);
    }

    /**
     * @return {string}|null
     */
    getDebitAccountNumber() {
        return this.get('debit_account_number');
    }

    /**
     * @param {string} debitAccountNumber
     */
    setDebitAccountNumber(debitAccountNumber) {
        this.set('debit_account_number', debitAccountNumber);
    }

    /**
     * @return {string}|null
     */
    getStatuses() {
        return this.get('statuses');
    }

    /**
     * @param {string} statuses
     */
    setStatuses(statuses) {
        this.set('statuses', statuses);
    }
}

export default TransfersFilter;
