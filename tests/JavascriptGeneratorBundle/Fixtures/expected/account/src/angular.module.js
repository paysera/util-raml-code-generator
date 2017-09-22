import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import AccountResult from './entity/AccountResult';
import Account from './entity/Account';
import AccountFilter from './entity/AccountFilter';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import AccountClient from './service/AccountClient';

export {
    AccountResult,
    Account,
    AccountFilter,
    DateFactory,
    ClientFactory,
    AccountClient,
};

class AngularClientFactory {

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

        return ClientFactory.create(factoryConfig).getAccountClient(tokenProvider);
    }
}

export default angular
    .module('vendor.http.account', [])
    .service('vendorHttpAccountClientFactory', AngularClientFactory)
    .name
;
