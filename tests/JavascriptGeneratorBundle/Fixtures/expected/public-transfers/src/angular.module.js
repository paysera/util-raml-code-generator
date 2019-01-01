import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';

import { createPublicTransfersClient } from './service/createClient';
import PublicTransfersClient from './service/PublicTransfersClient';

export {
    Money,
    Entity,
    createPublicTransfersClient,
    PublicTransfersClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {PublicTransfersClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createPublicTransfersClient(config));
    }

    /**
     * @param {PublicTransfersClient} client
     * @returns {PublicTransfersClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const getTransferRequiredSupplementOriginal = client.getTransferRequiredSupplement.bind(client);
        client.getTransferRequiredSupplement = (...args) => (
            this.$q.when(getTransferRequiredSupplementOriginal(...args))
        );
        const updateTransferSmsOriginal = client.updateTransferSms.bind(client);
        client.updateTransferSms = (...args) => (
            this.$q.when(updateTransferSmsOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.public-transfers-client', [])
    .service('vendorHttpPublicTransfersClientFactory', AngularClientFactory)
    .name;
