import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import { Entity } from '@paysera/http-client-common';

import { createCustomClient } from './service/createClient';
import CustomClient from './service/CustomClient';

export {
    Entity,
    createCustomClient,
    CustomClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {CustomClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createCustomClient(config));
    }

    /**
     * @param {CustomClient} client
     * @returns {CustomClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const customNameForMethodOriginal = client.customNameForMethod.bind(client);
        client.customNameForMethod = (...args) => (
            this.$q.when(customNameForMethodOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.custom-client', [])
    .service('vendorHttpCustomClientFactory', AngularClientFactory)
    .name;
