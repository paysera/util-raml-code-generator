import { Entity } from '@paysera/http-client-common';

class Reviewer extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getUserId() {
        return this.get('user_id');
    }

    /**
     * @param {string} userId
     */
    setUserId(userId) {
        this.set('user_id', userId);
    }

    /**
     * @return {string}
     */
    getDisplayName() {
        return this.get('display_name');
    }

    /**
     * @param {string} displayName
     */
    setDisplayName(displayName) {
        this.set('display_name', displayName);
    }
}

export default Reviewer;
