<?php

namespace Vendor\Test\CategoryApiBundle\Service;

use Paysera\Component\Serializer\Entity\Filter;
use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Vendor\Test\CategoryApiBundle\Repository\KeywordRepository;
use Doctrine\ORM\EntityManager;

class KeywordManager
{
    private $keywordRepository;
    private $entityManager;

    public function __construct(
        KeywordRepository $keywordRepository,
        EntityManager $entityManager
    ) {
        $this->keywordRepository = $keywordRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Filter $filter
     * @return Entities\Keyword
     */
    public function getKeywords(Filter $filter)
    {
        //TODO: generated_code
    }
}
