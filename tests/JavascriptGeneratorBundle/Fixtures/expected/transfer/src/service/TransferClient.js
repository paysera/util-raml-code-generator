import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import FilteredTransfersResult from '../entity/FilteredTransfersResult';
import TransferInput from '../entity/TransferInput';
import TransferOutput from '../entity/TransferOutput';
import TransferPassword from '../entity/TransferPassword';
import TransferRegistrationParameters from '../entity/TransferRegistrationParameters';
import TransfersBatch from '../entity/TransfersBatch';
import TransfersBatchResult from '../entity/TransfersBatchResult';
import TransfersFilter from '../entity/TransfersFilter';

class TransferClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Sign the transfer, even if no funds available.
     * PUT /transfer/{id}/sign
     *
     * @param {string} id
     * @param {TransferRegistrationParameters} transferRegistrationParameters
     * @return {Promise.<TransferOutput>}
     */
    signTransfer(id, transferRegistrationParameters) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/sign`,
            transferRegistrationParameters,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Sign and reserve money for transfer. Returns error if no funds available.
     * PUT /transfer/{id}/reserve
     *
     * @param {string} id
     * @param {TransferRegistrationParameters} transferRegistrationParameters
     * @return {Promise.<TransferOutput>}
     */
    reserveTransfer(id, transferRegistrationParameters) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/reserve`,
            transferRegistrationParameters,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Provide password for Transfer. Available only for internal transfers.
     * PUT /transfer/{id}/provide-password
     *
     * @param {string} id
     * @param {TransferPassword} transferPassword
     * @return {Promise.<TransferOutput>}
     */
    provideTransferPassword(id, transferPassword) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/provide-password`,
            transferPassword,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Freeze transfer. Available only for `reserved` transfers. Same as completing transfer but beneficiary cannot spend funds - they are reserved. Revoking transfer is possible after freezing.
     * PUT /transfer/{id}/freeze
     *
     * @param {string} id
     * @return {Promise.<TransferOutput>}
     */
    freezeTransfer(id) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/freeze`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Complete transfer. Available for `reserved` and `freezed` transfers.
     * PUT /transfer/{id}/complete
     *
     * @param {string} id
     * @return {Promise.<TransferOutput>}
     */
    completeTransfer(id) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/complete`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Make transfer visible in frontend for signing. If currency convert operations are related to transfer, they are done when transfer becomes `reserved`. If there are expectations in currency convert requests, transfer becomes `failed` together with related conversion request(s) if those expectations fails.
     * PUT /transfer/{id}/register
     *
     * @param {string} id
     * @param {TransferRegistrationParameters} transferRegistrationParameters
     * @return {Promise.<TransferOutput>}
     */
    registerTransfer(id, transferRegistrationParameters) {
        const request = createRequest(
            'PUT',
            `transfer/${encodeURIComponent(id)}/register`,
            transferRegistrationParameters,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Get transfer.
     * GET /transfer/{id}
     *
     * @param {string} id
     * @return {Promise.<TransferOutput>}
     */
    getTransfer(id) {
        const request = createRequest(
            'GET',
            `transfer/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }
    /**
     * Revoke transfer.
     * DELETE /transfer/{id}
     *
     * @param {string} id
     * @return {Promise.<TransferOutput>}
     */
    deleteTransfer(id) {
        const request = createRequest(
            'DELETE',
            `transfer/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

    /**
     * Reserve all transfers in a transaction. Possibly revoke other given transfers in same transaction. Possibly make currency convertions in in same transaction.
     * PUT /transfers/reserve
     *
     * @param {TransfersBatch} transfersBatch
     * @return {Promise.<TransfersBatchResult>}
     */
    reserveTransfers(transfersBatch) {
        const request = createRequest(
            'PUT',
            `transfers/reserve`,
            transfersBatch,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransfersBatchResult(data));
    }

    /**
     * Get list of transfers by filter
     * GET /transfers
     *
     * @param {TransfersFilter} transfersFilter
     * @return {Promise.<FilteredTransfersResult>}
     */
    getTransfers(transfersFilter) {
        const request = createRequest(
            'GET',
            `transfers`,
            transfersFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => new FilteredTransfersResult(data, 'transfers'));
    }

    /**
     * Create transfer in the system. Created transfer is invisible and will be deleted if no more actions are performed.

     * POST /transfer
     *
     * @param {TransferInput} transferInput
     * @return {Promise.<TransferOutput>}
     */
    createTransfer(transferInput) {
        const request = createRequest(
            'POST',
            `transfer`,
            transferInput,
        );

        return this.client
            .performRequest(request)
            .then(data => new TransferOutput(data));
    }

}

export default TransferClient;
