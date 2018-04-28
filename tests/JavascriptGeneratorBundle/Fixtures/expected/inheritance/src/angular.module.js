import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import User from './entity/User';
import UserLegal from './entity/UserLegal';
import UserNatural from './entity/UserNatural';
import UserBasic from './entity/UserBasic';
import UserLegalFilter from './entity/UserLegalFilter';
import UserNaturalFilter from './entity/UserNaturalFilter';
import UserFilter from './entity/UserFilter';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import InheritanceClient from './service/InheritanceClient';

export {
    User,
    UserLegal,
    UserNatural,
    UserBasic,
    UserLegalFilter,
    UserNaturalFilter,
    UserFilter,
    DateFactory,
    ClientFactory,
    InheritanceClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {InheritanceClient}
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
            ClientFactory.create(factoryConfig).getInheritanceClient(tokenProvider)
        );
    }

    /**
     * @param {InheritanceClient} client
     * @returns {InheritanceClient}
     */
    wrapQ(client) {
        const getUserNaturalsOriginal = client.getUserNaturals.bind(client);
        client.getUserNaturals = (...args) => {
            return this.$q.when(getUserNaturalsOriginal(...args));
        };
        const createNaturalUserOriginal = client.createNaturalUser.bind(client);
        client.createNaturalUser = (...args) => {
            return this.$q.when(createNaturalUserOriginal(...args));
        };
        const getUserLegalsOriginal = client.getUserLegals.bind(client);
        client.getUserLegals = (...args) => {
            return this.$q.when(getUserLegalsOriginal(...args));
        };
        const createLegalUserOriginal = client.createLegalUser.bind(client);
        client.createLegalUser = (...args) => {
            return this.$q.when(createLegalUserOriginal(...args));
        };
        const getUsersOriginal = client.getUsers.bind(client);
        client.getUsers = (...args) => {
            return this.$q.when(getUsersOriginal(...args));
        };
        const createUserOriginal = client.createUser.bind(client);
        client.createUser = (...args) => {
            return this.$q.when(createUserOriginal(...args));
        };

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.inheritance', [])
    .service('vendorHttpInheritanceClientFactory', AngularClientFactory)
    .name
;
