import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

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

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {QuestionnaireClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createQuestionnaireClient(config));
    }

    /**
     * @param {QuestionnaireClient} client
     * @returns {QuestionnaireClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const getQuestionnaireUsersIdsOriginal = client.getQuestionnaireUsersIds.bind(client);
        client.getQuestionnaireUsersIds = (...args) => (
            this.$q.when(getQuestionnaireUsersIdsOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.questionnaire-client', [])
    .service('vendorHttpQuestionnaireClientFactory', AngularClientFactory)
    .name;
