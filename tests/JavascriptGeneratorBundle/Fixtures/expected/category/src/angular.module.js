import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import Category from './entity/Category';
import CategoryFilter from './entity/CategoryFilter';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import CategoryClient from './service/CategoryClient';

export {
Category,
CategoryFilter,
    DateFactory,
    ClientFactory,
    CategoryClient,
};

class AngularClientFactory {

    /**
     * @param {object} config
     * @returns {CategoryClient}
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

        return ClientFactory.create(factoryConfig).getCategoryClient(tokenProvider);
    }
}

export default angular
    .module('paysera.http.account', [])
    .service('payseraHttpAccountClientFactory', AngularClientFactory)
    .name
;
