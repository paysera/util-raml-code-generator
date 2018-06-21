<?php

namespace Vendor\Test\AccountApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Paysera\Bundle\RestBundle\Repository\FilterAwareRepositoryInterface;
use Vendor\Test\AccountApiBundle\Entity\Account;
use Vendor\Test\AccountApiBundle\Entity\AccountFilter;

class AccountRepository extends EntityRepository implements FilterAwareRepositoryInterface
{
    /**
     * @param AccountFilter $filter
     *
     * @return Account[]
     */
    public function findByFilter($filter)
    {
        //TODO: generated_code
    }

    /**
    * @param AccountFilter $filter
    *
    * @return int
    */
    public function findCountByFilter($filter)
    {
        //TODO: generated_code
    }
}
