<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Service;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Vendor\Test\TransferSurveillanceApiBundle\Repository\MatcherRepository;
use Doctrine\ORM\EntityManager;

class MatcherManager
{
    private $matcherRepository;
    private $entityManager;

    public function __construct(
        MatcherRepository $matcherRepository,
        EntityManager $entityManager
    ) {
        $this->matcherRepository = $matcherRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Result|Entities\Matcher[]
     */
    public function getMatchers()
    {
        //TODO: generated_code
    }
}
