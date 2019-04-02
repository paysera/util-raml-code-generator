import { Entity } from '@paysera/http-client-common';

class DetailsOptions extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {boolean|null}
     */
    isPreserve() {
        return this.get('preserve');
    }

    /**
     * @param {boolean} preserve
     */
    setPreserve(preserve) {
        this.set('preserve', preserve);
    }
}

export default DetailsOptions;
