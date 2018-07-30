<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Vendor\Test\TransferSurveillanceApiBundle\Repository\CriterionRepository;
use Doctrine\ORM\EntityManager;

class CriterionManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\MatchCriteria $matchCriteria
     * @return null
     */
    public function deleteCriterion(Entities\MatchCriteria $matchCriteria)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function getCriterion(Entities\MatchCriteria $matchCriteria)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\MatchCriteria $matchCriteria
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function updateCriterion(Entities\MatchCriteria $originalMatchCriteria, Entities\MatchCriteria $updatedMatchCriteria)
    {
        //TODO: generated_code
    }
    /**
     * @return Result|Entities\MatchCriteria[]
     */
    public function getCriterias()
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\MatchCriteria $matchCriteria
     * @return Entities\MatchCriteria
     */
    public function createCriterion(Entities\MatchCriteria $matchCriteria)
    {
        //TODO: generated_code
    }
}
