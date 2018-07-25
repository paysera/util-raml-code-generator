import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import QuestionnaireUsersResult from '../entity/QuestionnaireUsersResult';

class QuestionnaireClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Get questionnaire users by filter
     * GET /questionnaires/users-id
     *
     * @return {Promise.<QuestionnaireUsersResult>}
     */
    getQuestionnaireUsersIds() {
        const request = createRequest(
            'GET',
            `questionnaires/users-id`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new QuestionnaireUsersResult(data, 'users_id'));
    }


}

export default QuestionnaireClient;
