import User from './User';

class UserNatural extends User {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getName() {
        return this.get('name');
    }

    /**
     * @param {string} name
     */
    setName(name) {
        this.set('name', name);
    }

    /**
     * @return {string}
     */
    getSurname() {
        return this.get('surname');
    }

    /**
     * @param {string} surname
     */
    setSurname(surname) {
        this.set('surname', surname);
    }
}

export default UserNatural;
