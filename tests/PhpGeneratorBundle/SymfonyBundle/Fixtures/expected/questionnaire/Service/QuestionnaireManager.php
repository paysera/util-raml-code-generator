<?php

namespace Vendor\Test\QuestionnaireApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\QuestionnaireApiBundle\Entity as Entities;
use Vendor\Test\QuestionnaireApiBundle\Repository\QuestionnaireRepository;
use Doctrine\ORM\EntityManager;

class QuestionnaireManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $locale
     * @return Result|integer[]
     */
    public function getQuestionnaireUsersIds($locale)
    {
        //TODO: generated_code
    }
}
