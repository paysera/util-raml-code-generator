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

UserBasic.types = {
    TYPE_LEGAL: 'legal',
    TYPE_NATURAL: 'natural',
};

export default UserBasic;
