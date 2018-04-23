import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class Natural extends UserInfo {
    constructor(data = []) {
        super(data);
        this.setType('natural');
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

export default Natural;
