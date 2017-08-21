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
     * @param {object|null} config
     * @returns {CategoryClient}
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

        return ClientFactory.create(factoryConfig).getCategoryClient(tokenProvider);
    }
}

export default angular
    .module('acme.http.category', [])
    .service('acmeHttpCategoryClientFactory', AngularClientFactory)
    .name
;
