import ConvertCurrency from './ConvertCurrency';
import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferRegistrationParameters extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {Array.<ConvertCurrency>}
     */
    getConvertCurrency() {
        let data = this.get('convert_currency');
        if (data === null) {
            return [];
        }

        let collection = [];
        for (let value of data) {
            collection.push(new ConvertCurrency(value));
        }

        return collection;
    }

    /**
     * @param {Array.<ConvertCurrency>} convertCurrency
     */
    setConvertCurrency(convertCurrency) {
        let data = [];
        for (let entity of convertCurrency) {
            data.push(entity.getData());
        }
        this.set('convert_currency', data);
    }
}

export default TransferRegistrationParameters;
