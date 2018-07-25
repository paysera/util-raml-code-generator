import { Result } from '@paysera/http-client-common';

/* eslint class-methods-use-this: ["error", { "exceptMethods": ["createItem"] }] */
class QuestionnaireUsersResult extends Result {
    /**
     * @param {Array} data
     * @returns {integer}
     */
    createItem(data) {
        return data;
    }
}

export default QuestionnaireUsersResult;
