import User from './User';

import DateFactory from '../service/DateFactory';

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
