import { Entity } from 'paysera-http-client-common';

import TransferOutput from '../entity/TransferOutput';
import DateFactory from '../service/DateFactory';

class TransfersBatchResult extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {Array.<TransferOutput>}
     */
    getRevokedTransfers() {
        let data = this.get('revoked_transfers');
        if (data === null) {
            return [];
        }

        let collection = [];
        for (let value of data) {
            collection.push(new TransferOutput(value));
        }

        return collection;
    }

    /**
     * @param {Array.<TransferOutput>} revokedTransfers
     */
    setRevokedTransfers(revokedTransfers) {
        let data = [];
        for (let entity of revokedTransfers) {
            data.push(entity.data);
        }
        this.data = data;
        }

    /**
     * @return {Array.<TransferOutput>}
     */
    getReservedTransfers() {
        let data = this.get('reserved_transfers');
        if (data === null) {
            return [];
        }

        let collection = [];
        for (let value of data) {
            collection.push(new TransferOutput(value));
        }

        return collection;
    }

    /**
     * @param {Array.<TransferOutput>} reservedTransfers
     */
    setReservedTransfers(reservedTransfers) {
        let data = [];
        for (let entity of reservedTransfers) {
            data.push(entity.data);
        }
        this.data = data;
        }
}

export default TransfersBatchResult;
