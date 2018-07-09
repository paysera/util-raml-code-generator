import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';

import DateFactory from '../service/DateFactory';

class OutCommissionRule extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getPercent() {
        return this.get('percent');
    }

    /**
     * @param {string} percent
     */
    setPercent(percent) {
        this.set('percent', percent);
    }

    /**
     * @return {Money}|null
     */
    getMin() {
        if (this.get('min')['amount'] === null || this.get('min')['currency'] === null) {
            return null;
        }
        return new Money(this.get('min')['amount'], this.get('min')['currency']);
    }

    /**
     * @param {Money} min
     */
    setMin(min) {
        this.set('min', {'amount':min.getAmount(), 'currency':min.getCurrency()});
    }

    /**
     * @return {Money}|null
     */
    getMax() {
        if (this.get('max')['amount'] === null || this.get('max')['currency'] === null) {
            return null;
        }
        return new Money(this.get('max')['amount'], this.get('max')['currency']);
    }

    /**
     * @param {Money} max
     */
    setMax(max) {
        this.set('max', {'amount':max.getAmount(), 'currency':max.getCurrency()});
    }

    /**
     * @return {Money}|null
     */
    getFix() {
        if (this.get('fix')['amount'] === null || this.get('fix')['currency'] === null) {
            return null;
        }
        return new Money(this.get('fix')['amount'], this.get('fix')['currency']);
    }

    /**
     * @param {Money} fix
     */
    setFix(fix) {
        this.set('fix', {'amount':fix.getAmount(), 'currency':fix.getCurrency()});
    }
}

export default OutCommissionRule;
