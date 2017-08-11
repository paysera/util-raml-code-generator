import { Result } from 'paysera-http-client-common';

import TransferOutput from './TransferOutput';

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
