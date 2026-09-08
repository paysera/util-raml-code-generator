<?php

namespace Paysera\Test\NullableTypesClient;

use Paysera\Test\NullableTypesClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class NullableTypesClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new NullableTypesClient($this->apiClient->withOptions($options));
    }

    /**
     * Get an inquiry
     * GET /inquiries/{id}
     *
     * @param string $id
     * @return Entities\Inquiry
     */
    public function getInquiry($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('inquiries/%s', rawurlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Inquiry($data);
    }

    /**
     * Update an inquiry
     * PUT /inquiries/{id}
     *
     * @param string $id
     * @param Entities\Inquiry $inquiry
     * @return Entities\Inquiry
     */
    public function updateInquiry($id, Entities\Inquiry $inquiry)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('inquiries/%s', rawurlencode($id)),
            $inquiry
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Inquiry($data);
    }
}
