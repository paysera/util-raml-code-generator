import { Result } from '@paysera/http-client-common';

/* eslint class-methods-use-this: ["error", { "exceptMethods": ["createItem"] }] */
class CurrencyResult extends Result {
    /**
     * @param {Array} data
     * @returns {string}
     */
    createItem(data) {
        return data;
    }
}

export default CurrencyResult;
