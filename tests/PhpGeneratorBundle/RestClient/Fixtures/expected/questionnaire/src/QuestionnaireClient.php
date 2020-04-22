<?php

namespace Paysera\Test\QuestionnaireClient;

use Paysera\Test\QuestionnaireClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class QuestionnaireClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new QuestionnaireClient($this->apiClient->withOptions($options));
    }

    /**
     * Get questionnaire users by filter
     * GET /questionnaires/users-id
     *
     * @return Entities\QuestionnaireUsersResult
     */
    public function getQuestionnaireUsersIds()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'questionnaires/users-id',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\QuestionnaireUsersResult($data, 'users_id');
    }
}
