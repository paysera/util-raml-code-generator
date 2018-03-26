<?php

namespace Paysera\Test\TestClient;

use Paysera\Test\TestClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class TransferSurveillanceClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Mark Inspection as accepted. Allow transfer to complete
     * PUT /transfer/inspection/{transferId}/accept
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function acceptTransferInspection($transferId, Entities\Review $review)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/inspection/%s/accept', urlencode($transferId)),
            $review
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Mark Inspection as cancelled/rejected. Do not allow the transfer to complete
     * PUT /transfer/inspection/{transferId}/cancel
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function cancelTransferInspection($transferId, Entities\Review $review)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/inspection/%s/cancel', urlencode($transferId)),
            $review
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Mark Inspection as audited.
     * PUT /transfer/inspection/{transferId}/audit
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function auditTransferInspection($transferId, Entities\Review $review)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/inspection/%s/audit', urlencode($transferId)),
            $review
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Mark Inspection as need additional info from user about the transfer.
     * PUT /transfer/inspection/{transferId}/request-user-info
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function requestTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/inspection/%s/request-user-info', urlencode($transferId)),
            $review
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Mark Inspection as received additional info from user about the transfer.
     * PUT /transfer/inspection/{transferId}/receive-user-info
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function receiveTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfer/inspection/%s/receive-user-info', urlencode($transferId)),
            $review
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Get Transfer Surveillance Matchers
     * GET /matchers
     *
     * @return Entities\MatchersResult
     */
    public function getMatchers()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'matchers',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\MatchersResult($data, 'items');
    }
    /**
     * Delete MatchCriteria
     * DELETE /criteria/{id}
     *
     * @param string $id
     * @return null
     */
    public function deleteCriterion($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('criteria/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Get MatchCriterion
     * GET /criteria/{id}
     *
     * @param string $id
     * @return Entities\MatchCriteria
     */
    public function getCriterion($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('criteria/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\MatchCriteria($data);
    }
    /**
     * Update MatchCriteria
     * PUT /criteria/{id}
     *
     * @param string $id
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function updateCriterion($id, Entities\MatchCriteria $matchCriteria)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('criteria/%s', urlencode($id)),
            $matchCriteria
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\MatchCriteria($data);
    }
    /**
     * Get MatchCriterias
     * GET /criteria
     *
     * @return Entities\MatchCriteriasResult
     */
    public function getCriterias()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'criteria',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\MatchCriteriasResult($data, 'items');
    }
    /**
     * Create MatchCriteria
     * POST /criteria
     *
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function createCriterion(Entities\MatchCriteria $matchCriteria)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'criteria',
            $matchCriteria
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\MatchCriteria($data);
    }
    /**
     * Enable rule
     * PUT /rules/{id}/enable
     *
     * @param string $id
     * @return null
     */
    public function enableRule($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('rules/%s/enable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Disable rule
     * PUT /rules/{id}/disable
     *
     * @param string $id
     * @return null
     */
    public function disableRule($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('rules/%s/disable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Get a single whitelist
     * GET /rules/{id}/whitelists/{whitelist_id}/profile-list
     *
     * @param string $id
     * @param string $whitelistId
     * @return Entities\Whitelist
     */
    public function getRuleWhitelistProfileLists($id, $whitelistId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('rules/%s/whitelists/%s/profile-list', urlencode($id), urlencode($whitelistId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Whitelist($data);
    }
    /**
     * Update whitelist
     * PUT /rules/{id}/whitelists/{whitelist_id}/profile-list
     *
     * @param string $id
     * @param string $whitelistId
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelistProfileList($id, $whitelistId, Entities\Whitelist $whitelist)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('rules/%s/whitelists/%s/profile-list', urlencode($id), urlencode($whitelistId)),
            $whitelist
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Whitelist($data);
    }
    /**
     * Get a single whitelist
     * GET /rules/{id}/whitelists/{whitelist_id}
     *
     * @param string $id
     * @param string $whitelistId
     * @return Entities\Whitelist
     */
    public function getRuleWhitelist($id, $whitelistId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('rules/%s/whitelists/%s', urlencode($id), urlencode($whitelistId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Whitelist($data);
    }
    /**
     * Update whitelist
     * PUT /rules/{id}/whitelists/{whitelist_id}
     *
     * @param string $id
     * @param string $whitelistId
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelist($id, $whitelistId, Entities\Whitelist $whitelist)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('rules/%s/whitelists/%s', urlencode($id), urlencode($whitelistId)),
            $whitelist
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Whitelist($data);
    }
    /**
     * Delete a whitelist
     * DELETE /rules/{id}/whitelists/{whitelist_id}
     *
     * @param string $id
     * @param string $whitelistId
     * @return null
     */
    public function deleteRuleWhitelist($id, $whitelistId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('rules/%s/whitelists/%s', urlencode($id), urlencode($whitelistId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Get all active whitelists for this rule
     * GET /rules/{id}/whitelists
     *
     * @param string $id
     * @return Entities\WhitelistsResult
     */
    public function getRuleWhitelists($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('rules/%s/whitelists', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\WhitelistsResult($data, 'whitelists');
    }
    /**
     * Add whitelist to a rule
     * POST /rules/{id}/whitelists
     *
     * @param string $id
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function createRuleWhitelist($id, Entities\Whitelist $whitelist)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            sprintf('rules/%s/whitelists', urlencode($id)),
            $whitelist
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Whitelist($data);
    }
    /**
     * Get a rule
     * GET /rules/{id}
     *
     * @param string $id
     * @return Entities\Rule
     */
    public function getRule($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('rules/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Rule($data);
    }
    /**
     * Update rule
     * PUT /rules/{id}
     *
     * @param string $id
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function updateRule($id, Entities\Rule $rule)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('rules/%s', urlencode($id)),
            $rule
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Rule($data);
    }
    /**
     * Delete a rule
     * DELETE /rules/{id}
     *
     * @param string $id
     * @return null
     */
    public function deleteRule($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('rules/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /rules
     *
     * @param Entities\RuleFilter $ruleFilter
     * @return Entities\RulesResult
     */
    public function getRules(Entities\RuleFilter $ruleFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'rules',
            $ruleFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\RulesResult($data, 'rules');
    }
    /**
     * Create a rule
     * POST /rules
     *
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function createRule(Entities\Rule $rule)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'rules',
            $rule
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Rule($data);
    }
}
