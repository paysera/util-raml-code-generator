import User from './User';

class UserBasic extends User {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getType() {
        return this.get('type');
    }

    /**
     * @param {string} type
     */
    setType(type) {
        this.set('type', type);
    }
}

export default UserBasic;
