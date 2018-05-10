import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import Account from './entity/Account';
import AccountFilter from './entity/AccountFilter';
import AccountResult from './entity/AccountResult';
import { Filter } from 'paysera-http-client-common';
import { Result } from 'paysera-http-client-common';
import UndescribedType from './entity/UndescribedType';
import { Entity } from 'paysera-http-client-common';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import AccountClient from './service/AccountClient';

export {
    Account,
    AccountFilter,
    AccountResult,
    Filter,
    Result,
    UndescribedType,
    Entity,
    DateFactory,
    ClientFactory,
    AccountClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {AccountClient}
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
            ClientFactory.create(factoryConfig).getAccountClient(tokenProvider)
        );
    }

    /**
     * @param {AccountClient} client
     * @returns {AccountClient}
     */
    wrapQ(client) {
        const getAccountScriptsOriginal = client.getAccountScripts.bind(client);
        client.getAccountScripts = (...args) => {
            return this.$q.when(getAccountScriptsOriginal(...args));
        };
        const getAccountsOriginal = client.getAccounts.bind(client);
        client.getAccounts = (...args) => {
            return this.$q.when(getAccountsOriginal(...args));
        };

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.account', [])
    .service('vendorHttpAccountClientFactory', AngularClientFactory)
    .name
;
