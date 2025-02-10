<?php

namespace Paysera\Test\TransferSurveillanceAssistantClient;

use Paysera\Test\TransferSurveillanceAssistantClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class TransferSurveillanceAssistantClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new TransferSurveillanceAssistantClient($this->apiClient->withOptions($options));
    }

    /**
     * Submit a new analysis task for processing
     * POST /analysis-tasks
     *
     * @param Entities\AnalysisTaskInput $analysisTaskInput
     * @return Entities\AnalysisTaskOutput
     */
    public function createAnalysisTask(Entities\AnalysisTaskInput $analysisTaskInput)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'analysis-tasks',
            $analysisTaskInput
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\AnalysisTaskOutput($data);
    }

    /**
     * I am not a real endpoint
     * PUT /analysis-tasks
     *
     * @return null
     */
    public function updateAnalysisTask()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            'analysis-tasks',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
