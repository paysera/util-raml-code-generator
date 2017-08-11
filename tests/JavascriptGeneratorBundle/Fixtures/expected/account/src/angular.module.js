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
     * @param {object} config
     * @returns {AccountClient}
     */
    getClient(config) {
        const tokenProvider = new TokenProvider(
            new Scope(config.scope),
            config.initialTokenProvider,
        );

        const factoryConfig = {
            baseUrl: config.baseUrl,
            refreshTokenProvider: config.refreshTokenProvider,
        };

        return ClientFactory.create(factoryConfig).getAccountClient(tokenProvider);
    }
}

export default angular
    .module('paysera.http.account', [])
    .service('payseraHttpAccountClientFactory', AngularClientFactory)
    .name
;
