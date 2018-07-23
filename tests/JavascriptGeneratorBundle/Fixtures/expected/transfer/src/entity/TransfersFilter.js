import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

class TransfersFilter extends Entity {
    /**
     * @return {DateTime}|null
     */
    getCreatedDateFrom() {
        if (this.get('created_date_from') == null) {
            return null;
        }
        return DateTime.fromMillis(this.get('created_date_from') * 1000);
    }

    /**
     * @param {DateTime} createdDateFrom
     */
    setCreatedDateFrom(createdDateFrom) {
        this.set('created_date_from', Math.floor(createdDateFrom.toMillis()/1000));
    }

    /**
     * @return {DateTime}|null
     */
    getCreatedDateTo() {
        if (this.get('created_date_to') == null) {
            return null;
        }
        return DateTime.fromMillis(this.get('created_date_to') * 1000);
    }

    /**
     * @param {DateTime} createdDateTo
     */
    setCreatedDateTo(createdDateTo) {
        this.set('created_date_to', Math.floor(createdDateTo.toMillis()/1000));
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
