<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Controller;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\TransferSurveillanceApiBundle\Service\CriterionManager;
use Vendor\Test\TransferSurveillanceApiBundle\CriterionPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class CriterionApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $criterionManager;
    
    public function __construct(
        CriterionManager $criterionManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->criterionManager = $criterionManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Delete MatchCriteria
     * DELETE /criteria/{id}
     *
     * @param Entities\MatchCriteria $matchCriteria
     * @return null
     */
    public function deleteCriterion(Entities\MatchCriteria $matchCriteria)
    {
        $this->authorizationChecker->check(CriterionPermissions::DELETE_CRITERION);
        $this->criterionManager->deleteCriterion($matchCriteria);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Get MatchCriterion
     * GET /criteria/{id}
     *
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function getCriterion(Entities\MatchCriteria $matchCriteria)
    {
        $this->authorizationChecker->check(CriterionPermissions::GET_CRITERION);
        return $this->criterionManager->getCriterion($matchCriteria);
    }
    /**
     * Update MatchCriteria
     * PUT /criteria/{id}
     *
     * @param Entities\MatchCriteria $originalMatchCriteria
     * @param Entities\MatchCriteria $updatedMatchCriteria
     * @return Entities\MatchCriteria
     */
    public function updateCriterion(Entities\MatchCriteria $originalMatchCriteria, Entities\MatchCriteria $updatedMatchCriteria)
    {
        $this->authorizationChecker->check(CriterionPermissions::UPDATE_CRITERION);
        $result = $this->criterionManager->updateCriterion($originalMatchCriteria, $updatedMatchCriteria);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Get MatchCriterias
     * GET /criteria
     *
     * @return Result|Entities\MatchCriteria[]
     */
    public function getCriterias()
    {
        $this->authorizationChecker->check(CriterionPermissions::GET_CRITERIAS);
        return $this->criterionManager->getCriterias();
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
        $this->authorizationChecker->check(CriterionPermissions::CREATE_CRITERION);
        $result = $this->criterionManager->createCriterion($matchCriteria);
        $this->entityManager->flush();
        return $result;
    }
}
