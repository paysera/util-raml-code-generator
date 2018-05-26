import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import { Filter } from 'paysera-http-client-common';
import User from './entity/User';
import UserBasic from './entity/UserBasic';
import UserFilter from './entity/UserFilter';
import UserLegal from './entity/UserLegal';
import UserLegalFilter from './entity/UserLegalFilter';
import UserNatural from './entity/UserNatural';
import UserNaturalFilter from './entity/UserNaturalFilter';
import { Entity } from 'paysera-http-client-common';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import InheritanceClient from './service/InheritanceClient';

export {
    Filter,
    User,
    UserBasic,
    UserFilter,
    UserLegal,
    UserLegalFilter,
    UserNatural,
    UserNaturalFilter,
    Entity,
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
        const getUserNaturalOriginal = client.getUserNatural.bind(client);
        client.getUserNatural = (...args) => {
            return this.$q.when(getUserNaturalOriginal(...args));
        };
        const createNaturalUserOriginal = client.createNaturalUser.bind(client);
        client.createNaturalUser = (...args) => {
            return this.$q.when(createNaturalUserOriginal(...args));
        };
        const getUserLegalOriginal = client.getUserLegal.bind(client);
        client.getUserLegal = (...args) => {
            return this.$q.when(getUserLegalOriginal(...args));
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
    .module('vendor.http.inheritance-client', [])
    .service('vendorHttpInheritanceClientFactory', AngularClientFactory)
    .name
;
