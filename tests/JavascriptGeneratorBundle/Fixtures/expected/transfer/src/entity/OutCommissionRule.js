import { Entity } from 'paysera-http-client-common';

import Money from '../entity/Money';
import DateFactory from '../service/DateFactory';

class OutCommissionRule extends Entity {
    constructor(data = []) {
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
        return new Money(this.get('min'));
    }

    /**
     * @param {Money} min
     */
    setMin(min) {
        this.set('min', min.data);
    }

    /**
     * @return {Money}|null
     */
    getMax() {
        return new Money(this.get('max'));
    }

    /**
     * @param {Money} max
     */
    setMax(max) {
        this.set('max', max.data);
    }

    /**
     * @return {Money}|null
     */
    getFix() {
        return new Money(this.get('fix'));
    }

    /**
     * @param {Money} fix
     */
    setFix(fix) {
        this.set('fix', fix.data);
    }
}

export default OutCommissionRule;
