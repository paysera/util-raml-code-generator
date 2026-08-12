import { Entity } from '@paysera/http-client-common';

class OrderLine extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getSku() {
        return this.get('sku');
    }

    /**
     * @param {string} sku
     */
    setSku(sku) {
        this.set('sku', sku);
    }

    /**
     * @return {Number}
     */
    getQuantity() {
        return this.get('quantity');
    }

    /**
     * @param {Number} quantity
     */
    setQuantity(quantity) {
        this.set('quantity', quantity);
    }
}

export default OrderLine;
