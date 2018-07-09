import { Entity } from '@paysera/http-client-common';

import DateFactory from '../service/DateFactory';

class Category extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
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
     * @return {string}|null
     */
    getParentId() {
        return this.get('parent_id');
    }

    /**
     * @param {string} parentId
     */
    setParentId(parentId) {
        this.set('parent_id', parentId);
    }

    /**
     * @return {Array.<string>}
     */
    getTitles() {
        return this.get('titles');
    }

    /**
     * @param {Array.<string>} titles
     */
    setTitles(titles) {
        this.set('titles', titles);
    }

    /**
     * @return {string}|null
     */
    getStatus() {
        return this.get('status');
    }

    /**
     * @param {string} status
     */
    setStatus(status) {
        this.set('status', status);
    }
}

export default Category;
