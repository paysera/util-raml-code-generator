import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import Legal from './entity/Legal';
import Natural from './entity/Natural';
import UserInfo from './entity/UserInfo';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

import { createUserInfoClient } from './service/createClient';
import UserInfoClient from './service/UserInfoClient';

export {
    Legal,
    Natural,
    UserInfo,
    DateTime,
    Entity,
    createUserInfoClient,
    UserInfoClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {UserInfoClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createUserInfoClient(config));
    }

    /**
     * @param {UserInfoClient} client
     * @returns {UserInfoClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const createLegalUserOriginal = client.createLegalUser.bind(client);
        client.createLegalUser = (...args) => (
            this.$q.when(createLegalUserOriginal(...args))
        );
        const createNaturalUserOriginal = client.createNaturalUser.bind(client);
        client.createNaturalUser = (...args) => (
            this.$q.when(createNaturalUserOriginal(...args))
        );
        const getUserInformationOriginal = client.getUserInformation.bind(client);
        client.getUserInformation = (...args) => (
            this.$q.when(getUserInformationOriginal(...args))
        );
        const updateUserInformationOriginal = client.updateUserInformation.bind(client);
        client.updateUserInformation = (...args) => (
            this.$q.when(updateUserInformationOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.user-info-client', [])
    .service('vendorHttpUserInfoClientFactory', AngularClientFactory)
    .name;
