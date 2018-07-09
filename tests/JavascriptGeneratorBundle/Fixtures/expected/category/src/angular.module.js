import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import Category from './entity/Category';
import CategoryFilter from './entity/CategoryFilter';
import { Filter } from '@paysera/http-client-common';
import { Entity } from '@paysera/http-client-common';

import DateFactory from './service/DateFactory';
import { createCategoryClient } from './service/createClient';
import CategoryClient from './service/CategoryClient';

export {
    Category,
    CategoryFilter,
    Filter,
    Entity,
    DateFactory,
    createCategoryClient,
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
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createCategoryClient(config));
    }

    /**
     * @param {CategoryClient} client
     * @returns {CategoryClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const enableCategoryOriginal = client.enableCategory.bind(client);
        client.enableCategory = (...args) => (
            this.$q.when(enableCategoryOriginal(...args))
        );
        const disableCategoryOriginal = client.disableCategory.bind(client);
        client.disableCategory = (...args) => (
            this.$q.when(disableCategoryOriginal(...args))
        );
        const updateCategoryOriginal = client.updateCategory.bind(client);
        client.updateCategory = (...args) => (
            this.$q.when(updateCategoryOriginal(...args))
        );
        const deleteCategoryOriginal = client.deleteCategory.bind(client);
        client.deleteCategory = (...args) => (
            this.$q.when(deleteCategoryOriginal(...args))
        );
        const getCategoriesOriginal = client.getCategories.bind(client);
        client.getCategories = (...args) => (
            this.$q.when(getCategoriesOriginal(...args))
        );
        const createCategoryOriginal = client.createCategory.bind(client);
        client.createCategory = (...args) => (
            this.$q.when(createCategoryOriginal(...args))
        );
        const getKeywordsOriginal = client.getKeywords.bind(client);
        client.getKeywords = (...args) => (
            this.$q.when(getKeywordsOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.category-client', [])
    .service('vendorHttpCategoryClientFactory', AngularClientFactory)
    .name;
