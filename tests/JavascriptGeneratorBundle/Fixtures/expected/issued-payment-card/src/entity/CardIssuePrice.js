import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';

class CardIssuePrice extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {Money}
     */
    getPrice() {
        return new Money(this.get('price')['amount'], this.get('price')['currency']);
    }

    /**
     * @param {Money} price
     */
    setPrice(price) {
        this.set('price', {'amount':price.getAmount(), 'currency':price.getCurrency()});
    }

    /**
     * @return {string}
     */
    getCountry() {
        return this.get('country');
    }

    /**
     * @param {string} country
     */
    setCountry(country) {
        this.set('country', country);
    }

    /**
     * @return {string}
     */
    getClientType() {
        return this.get('client_type');
    }

    /**
     * @param {string} clientType
     */
    setClientType(clientType) {
        this.set('client_type', clientType);
    }
}

export default CardIssuePrice;
