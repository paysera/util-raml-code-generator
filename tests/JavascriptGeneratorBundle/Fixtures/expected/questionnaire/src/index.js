import { Result } from '@paysera/http-client-common';
import QuestionnaireUsersResult from './entity/QuestionnaireUsersResult';
import { Entity } from '@paysera/http-client-common';

import { createQuestionnaireClient } from './service/createClient';
import QuestionnaireClient from './service/QuestionnaireClient';

export {
    Result,
    QuestionnaireUsersResult,
    Entity,
    createQuestionnaireClient,
    QuestionnaireClient,
};
