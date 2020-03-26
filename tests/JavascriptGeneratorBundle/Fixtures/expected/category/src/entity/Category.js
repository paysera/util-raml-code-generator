import { Entity } from '@paysera/http-client-common';

class Category extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string|null}
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
    getPhoto() {
        return atob(this.get('photo'));
    }

    /**
     * @param {string} photo
     */
    setPhoto(photo) {
        this.set('photo', btoa(photo));
    }

    /**
     * @return {string|null}
     */
    getAvatar() {
        if (this.get('avatar') === null) {
            return null;
        }
        return atob(this.get('avatar'));
    }

    /**
     * @param {string} avatar
     */
    setAvatar(avatar) {
        if (avatar === null) {
            this.set('avatar', null);
            return;
        }
        this.set('avatar', btoa(avatar));
    }

    /**
     * @return {string|null}
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
     * @return {string|null}
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

    /**
     * @return {boolean}
     */
    isPrivate() {
        return this.get('private');
    }

    /**
     * @param {boolean} _private
     */
    setPrivate(_private) {
        this.set('private', _private);
    }
}

Category.statuses = {
    STATUS_ACTIVE: 'active',
    STATUS_INACTIVE: 'inactive',
};

export default Category;
