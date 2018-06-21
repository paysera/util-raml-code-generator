<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Paysera\Bundle\RestBundle\Repository\FilterAwareRepositoryInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\Rule;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\RuleFilter;

class RuleRepository extends EntityRepository implements FilterAwareRepositoryInterface
{
    /**
     * @param RuleFilter $filter
     *
     * @return Rule[]
     */
    public function findByFilter($filter)
    {
        //TODO: generated_code
    }

    /**
    * @param RuleFilter $filter
    *
    * @return int
    */
    public function findCountByFilter($filter)
    {
        //TODO: generated_code
    }
}
