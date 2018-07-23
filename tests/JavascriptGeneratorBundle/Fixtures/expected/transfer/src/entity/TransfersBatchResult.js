import TransferOutput from './TransferOutput';
import { Entity } from '@paysera/http-client-common';

class TransfersBatchResult extends Entity {
    constructor(data = {}) {
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
            data.push(entity.getData());
        }
        this.set('revoked_transfers', data);
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
            data.push(entity.getData());
        }
        this.set('reserved_transfers', data);
    }
}

export default TransfersBatchResult;
