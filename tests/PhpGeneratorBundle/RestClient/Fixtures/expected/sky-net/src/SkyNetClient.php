<?php

namespace Paysera\Test\SkyNetClient;

use Paysera\Test\SkyNetClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class SkyNetClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new SkyNetClient($this->apiClient->withOptions($options));
    }

    /**
     * Set the target of termination
     * POST /termination
     *
     * @param Entities\TerminationInput $terminationInput
     * @return Entities\TerminationOutput
     */
    public function createTermination(Entities\TerminationInput $terminationInput)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'termination',
            $terminationInput
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\TerminationOutput($data);
    }

    /**
     * Change the target of termination
     * PUT /termination
     *
     * @param Entities\TerminationInput $terminationInput
     * @return null
     */
    public function updateTermination(Entities\TerminationInput $terminationInput)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            'termination',
            $terminationInput
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
