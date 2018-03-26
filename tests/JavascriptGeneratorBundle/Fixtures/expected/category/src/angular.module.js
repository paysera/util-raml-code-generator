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
    constructor($q) {
        this.$q = $q;
    }

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

        return this.wrapQ(
            ClientFactory.create(factoryConfig).getCategoryClient(tokenProvider)
        );
    }

    /**
     * @param {CategoryClient} client
     * @returns {CategoryClient}
     */
    wrapQ(client) {
        const enableCategoryOriginal = client.enableCategory.bind(client);
        client.enableCategory = (...args) => {
            return this.$q.when(enableCategoryOriginal(...args));
        };
        const disableCategoryOriginal = client.disableCategory.bind(client);
        client.disableCategory = (...args) => {
            return this.$q.when(disableCategoryOriginal(...args));
        };
        const updateCategoryOriginal = client.updateCategory.bind(client);
        client.updateCategory = (...args) => {
            return this.$q.when(updateCategoryOriginal(...args));
        };
        const deleteCategoryOriginal = client.deleteCategory.bind(client);
        client.deleteCategory = (...args) => {
            return this.$q.when(deleteCategoryOriginal(...args));
        };
        const getCategoriesOriginal = client.getCategories.bind(client);
        client.getCategories = (...args) => {
            return this.$q.when(getCategoriesOriginal(...args));
        };
        const createCategoryOriginal = client.createCategory.bind(client);
        client.createCategory = (...args) => {
            return this.$q.when(createCategoryOriginal(...args));
        };

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.category', [])
    .service('vendorHttpCategoryClientFactory', AngularClientFactory)
    .name
;
