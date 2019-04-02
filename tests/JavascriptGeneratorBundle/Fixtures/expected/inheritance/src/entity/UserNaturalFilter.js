import { Entity } from '@paysera/http-client-common';

class UserNaturalFilter extends Entity {
    /**
     * @return {string|null}
     */
    getFirstName() {
        return this.get('first_name');
    }

    /**
     * @param {string} firstName
     */
    setFirstName(firstName) {
        this.set('first_name', firstName);
    }

    /**
     * @return {string|null}
     */
    getLastName() {
        return this.get('last_name');
    }

    /**
     * @param {string} lastName
     */
    setLastName(lastName) {
        this.set('last_name', lastName);
    }
}

export default UserNaturalFilter;
