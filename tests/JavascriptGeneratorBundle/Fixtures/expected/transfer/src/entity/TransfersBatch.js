import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransfersBatch extends Entity {

    /**
     * @return {Array.<string>}|null
     */
    getRevokedTransfers() {
        return this.get('revoked_transfers');
    }

    /**
     * @param {Array.<string>} revokedTransfers
     */
    setRevokedTransfers(revokedTransfers) {
        this.set('revoked_transfers', revokedTransfers);
    }

    /**
     * @return {Array.<string>}|null
     */
    getReservedTransfers() {
        return this.get('reserved_transfers');
    }

    /**
     * @param {Array.<string>} reservedTransfers
     */
    setReservedTransfers(reservedTransfers) {
        this.set('reserved_transfers', reservedTransfers);
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
            data.push(entity.data);
        }
        this.data = data;
        }
}

export default TransfersBatch;
