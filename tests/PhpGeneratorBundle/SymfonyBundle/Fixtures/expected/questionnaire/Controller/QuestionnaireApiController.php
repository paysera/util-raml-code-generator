<?php

namespace Vendor\Test\QuestionnaireApiBundle\Controller;

use Vendor\Test\QuestionnaireApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\QuestionnaireApiBundle\Service\QuestionnaireManager;
use Vendor\Test\QuestionnaireApiBundle\QuestionnairePermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class QuestionnaireApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $questionnaireManager;
    
    public function __construct(
        QuestionnaireManager $questionnaireManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->questionnaireManager = $questionnaireManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Get questionnaire users by filter
     * GET /questionnaires/users-id
     *
     * @param string $locale
     * @return Result|integer[]
     */
    public function getQuestionnaireUsersIds($locale)
    {
        $this->authorizationChecker->check(QuestionnairePermissions::GET_QUESTIONNAIRE_USERS_IDS);
        return $this->questionnaireManager->getQuestionnaireUsersIds($locale);
    }
}
