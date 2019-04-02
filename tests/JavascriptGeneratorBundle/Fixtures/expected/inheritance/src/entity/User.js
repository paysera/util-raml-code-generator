import { Entity } from '@paysera/http-client-common';

class User extends Entity {
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
}

export default User;
