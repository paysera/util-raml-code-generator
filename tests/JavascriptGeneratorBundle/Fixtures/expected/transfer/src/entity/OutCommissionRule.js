import { Money } from '@paysera/money/src/Money';
import { Entity } from 'paysera-http-client-common';

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
        if (this.get('min_amount') == null && this.get('min_currency') == null) {
            return null;
        }
        return new Money(this.get('min_amount'), this.get('min_currency'));
    }

    /**
     * @param {Money} min
     */
    setMin(min) {
        this.set('min_amount', min.getAmount());
        this.set('min_currency', min.getCurrency());
    }

    /**
     * @return {Money}|null
     */
    getMax() {
        if (this.get('max_amount') == null && this.get('max_currency') == null) {
            return null;
        }
        return new Money(this.get('max_amount'), this.get('max_currency'));
    }

    /**
     * @param {Money} max
     */
    setMax(max) {
        this.set('max_amount', max.getAmount());
        this.set('max_currency', max.getCurrency());
    }

    /**
     * @return {Money}|null
     */
    getFix() {
        if (this.get('fix_amount') == null && this.get('fix_currency') == null) {
            return null;
        }
        return new Money(this.get('fix_amount'), this.get('fix_currency'));
    }

    /**
     * @param {Money} fix
     */
    setFix(fix) {
        this.set('fix_amount', fix.getAmount());
        this.set('fix_currency', fix.getCurrency());
    }
}

export default OutCommissionRule;
