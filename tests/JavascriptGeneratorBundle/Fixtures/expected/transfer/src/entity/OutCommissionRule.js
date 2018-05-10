import Money from './Money';
import { Entity } from 'paysera-http-client-common';

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
        if (this.get('min') == null) {
            return null;
        }
        return new Money(this.get('min'));
    }

    /**
     * @param {Money} min
     */
    setMin(min) {
        this.set('min', min.getData());
    }

    /**
     * @return {Money}|null
     */
    getMax() {
        if (this.get('max') == null) {
            return null;
        }
        return new Money(this.get('max'));
    }

    /**
     * @param {Money} max
     */
    setMax(max) {
        this.set('max', max.getData());
    }

    /**
     * @return {Money}|null
     */
    getFix() {
        if (this.get('fix') == null) {
            return null;
        }
        return new Money(this.get('fix'));
    }

    /**
     * @param {Money} fix
     */
    setFix(fix) {
        this.set('fix', fix.getData());
    }
}

export default OutCommissionRule;
