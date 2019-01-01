import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import { Money } from '@paysera/money';

class PublicTransfersClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Returns the amount required as an addition to the account balance in order to be able to execute the transfer.
     * GET /transfers/{transferId}/required-supplement
     *
     * @param {string} transferId
     * @return {Promise.<Money>}
     */
    getTransferRequiredSupplement(transferId) {
        const request = createRequest(
            'GET',
            `transfers/${encodeURIComponent(transferId)}/required-supplement`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Money(data));
    }

    /**
     * Unlocks SMS challenge
     * PUT /transfers/{transferId}/sms
     *
     * @param {string} transferId
     * @return {Promise.<null>}
     */
    updateTransferSms(transferId) {
        const request = createRequest(
            'PUT',
            `transfers/${encodeURIComponent(transferId)}/sms`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }



}

export default PublicTransfersClient;
