<?php

namespace Vendor\Test\CategoryApiBundle\Controller;

use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Filter;
use Vendor\Test\CategoryApiBundle\Service\KeywordManager;
use Vendor\Test\CategoryApiBundle\KeywordPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class KeywordApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $keywordManager;
    
    public function __construct(
        KeywordManager $keywordManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->keywordManager = $keywordManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Standard SQL-style Result filtering
     * GET /keywords
     *
     * @param Filter $filter
     * @return Entities\Keyword
     */
    public function getKeywords(Filter $filter)
    {
        $this->authorizationChecker->check(KeywordPermissions::GET_KEYWORDS);
        return $this->keywordManager->getKeywords($filter);
    }
}
