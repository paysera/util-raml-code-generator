<?php

namespace Paysera\Test\TestClient;

use Paysera\Test\TestClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class TransferClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Sign the transfer, even if no funds available.
     * PUT /transfer/{id}/sign
     *
     * @param string $id
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function signTransfer($id, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/sign', urlencode($id)),
            $transferRegistrationParameters
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Sign and reserve money for transfer. Returns error if no funds available.
     * PUT /transfer/{id}/reserve
     *
     * @param string $id
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function reserveTransfer($id, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/reserve', urlencode($id)),
            $transferRegistrationParameters
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Provide password for Transfer. Available only for internal transfers.
     * PUT /transfer/{id}/provide-password
     *
     * @param string $id
     * @param Entities\TransferPassword $transferPassword
     * @return Entities\TransferOutput
     */
    public function provideTransferPassword($id, Entities\TransferPassword $transferPassword)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/provide-password', urlencode($id)),
            $transferPassword
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Freeze transfer. Available only for `reserved` transfers. Same as completing transfer but beneficiary cannot spend funds - they are reserved. Revoking transfer is possible after freezing.
     * PUT /transfer/{id}/freeze
     *
     * @param string $id
     * @return Entities\TransferOutput
     */
    public function freezeTransfer($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/freeze', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Complete transfer. Available for `reserved` and `freezed` transfers.
     * PUT /transfer/{id}/complete
     *
     * @param string $id
     * @return Entities\TransferOutput
     */
    public function completeTransfer($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/complete', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Make transfer visible in frontend for signing. If currency convert operations are related to transfer, they are done when transfer becomes `reserved`. If there are expectations in currency convert requests, transfer becomes `failed` together with related conversion request(s) if those expectations fails.
     * PUT /transfer/{id}/register
     *
     * @param string $id
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function registerTransfer($id, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/%s/register', urlencode($id)),
            $transferRegistrationParameters
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Get transfer.
     * GET /transfer/{id}
     *
     * @param string $id
     * @return Entities\TransferOutput
     */
    public function getTransfer($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('transfer/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }
    /**
     * Revoke transfer.
     * DELETE /transfer/{id}
     *
     * @param string $id
     * @return Entities\TransferOutput
     */
    public function deleteTransfer($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('transfer/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Create transfer in the system. Created transfer is invisible and will be deleted if no more actions are performed.

     * POST /transfer
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function createTransfer(Entities\TransferInput $transferInput)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'transfer',
            $transferInput
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransferOutput($data);
    }

    /**
     * Reserve all transfers in a transaction. Possibly revoke other given transfers in same transaction. Possibly make currency convertions in in same transaction.
     * PUT /transfers/reserve
     *
     * @param Entities\TransfersBatch $transfersBatch
     * @return Entities\TransfersBatchResult
     */
    public function reserveTransfers(Entities\TransfersBatch $transfersBatch)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            'transfers/reserve',
            $transfersBatch
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TransfersBatchResult($data);
    }

    /**
     * Get list of transfers by filter
     * GET /transfers
     *
     * @param Entities\TransfersFilter $transfersFilter
     * @return Entities\FilteredTransfersResult
     */
    public function getTransfers(Entities\TransfersFilter $transfersFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'transfers',
            $transfersFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\FilteredTransfersResult($data, 'transfers');
    }

}
