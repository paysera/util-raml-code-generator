import { Entity } from '@paysera/http-client-common';

class UndescribedType extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {Number}
     */
    getAge() {
        return this.get('age');
    }

    /**
     * @param {Number} age
     */
    setAge(age) {
        this.set('age', age);
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
}

export default UndescribedType;
