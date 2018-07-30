<?php

namespace Vendor\Test\QuestionnaireApiBundle\Voter;

use Vendor\Test\QuestionnaireApiBundle\QuestionnairePermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class QuestionnaireScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            QuestionnairePermissions::GET_QUESTIONNAIRE_USERS_IDS => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
