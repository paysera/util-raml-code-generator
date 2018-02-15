import { Entity } from 'paysera-http-client-common';

class Filter extends Entity
{

    /**
     * @return {Number}|null
     */
    getLimit() {
        return this.get('limit');
    }

    /**
     * @param {Number} limit
     */
    setLimit(limit) {
        this.set('limit', limit);
    }

    /**
     * @return {Number}|null
     */
    getOffset() {
        return this.get('offset');
    }

    /**
     * @param {Number} offset
     */
    setOffset(offset) {
        this.set('offset', offset);
    }

    /**
     * @return {string}|null
     */
    getOrderBy() {
        return this.get('order_by');
    }

    /**
     * @param {string} orderBy
     */
    setOrderBy(orderBy) {
        this.set('order_by', orderBy);
    }

    /**
     * @return {string}|null
     */
    getOrderDirection() {
        return this.get('order_direction');
    }

    /**
     * @param {string} orderDirection
     */
    setOrderDirection(orderDirection) {
        this.set('order_direction', orderDirection);
    }
}

export default Filter;
