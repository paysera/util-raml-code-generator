import { Result } from '@paysera/http-client-common';
import TransferOutput from './TransferOutput';

/* eslint class-methods-use-this: ["error", { "exceptMethods": ["createItem"] }] */
class FilteredTransfersResult extends Result {
    /**
     * @param {Array} data
     * @returns {TransferOutput}
     */
    createItem(data) {
        return new TransferOutput(data);
    }
}

export default FilteredTransfersResult;
