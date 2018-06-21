import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import Legal from './entity/Legal';
import Natural from './entity/Natural';
import UserInfo from './entity/UserInfo';
import { Entity } from 'paysera-http-client-common';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import UserInfoClient from './service/UserInfoClient';

export {
    Legal,
    Natural,
    UserInfo,
    Entity,
    DateFactory,
    ClientFactory,
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
    getClient(config) {
        const factoryConfig = {};
        let tokenProvider = null;

        if (config && config.scope && config.initialTokenProvider) {
            tokenProvider = new TokenProvider(
                new Scope(config.scope),
                config.initialTokenProvider,
            );
        }

        if (config && config.baseUrl) {
            factoryConfig.baseUrl = config.baseUrl;
        }

        if (config && config.refreshTokenProvider) {
            factoryConfig.refreshTokenProvider = config.refreshTokenProvider;
        }

        return this.wrapQ(
            ClientFactory.create(factoryConfig).getUserInfoClient(tokenProvider)
        );
    }

    /**
     * @param {UserInfoClient} client
     * @returns {UserInfoClient}
     */
    wrapQ(client) {
        const createLegalUserOriginal = client.createLegalUser.bind(client);
        client.createLegalUser = (...args) => {
            return this.$q.when(createLegalUserOriginal(...args));
        };
        const createNaturalUserOriginal = client.createNaturalUser.bind(client);
        client.createNaturalUser = (...args) => {
            return this.$q.when(createNaturalUserOriginal(...args));
        };
        const getUserInformationOriginal = client.getUserInformation.bind(client);
        client.getUserInformation = (...args) => {
            return this.$q.when(getUserInformationOriginal(...args));
        };
        const updateUserInformationOriginal = client.updateUserInformation.bind(client);
        client.updateUserInformation = (...args) => {
            return this.$q.when(updateUserInformationOriginal(...args));
        };

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.user-info-client', [])
    .service('vendorHttpUserInfoClientFactory', AngularClientFactory)
    .name
;
