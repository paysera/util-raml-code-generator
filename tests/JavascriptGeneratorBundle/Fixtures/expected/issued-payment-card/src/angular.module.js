import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import CardIssuePrice from './entity/CardIssuePrice';
import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';

import { createIssuedPaymentCardClient } from './service/createClient';
import IssuedPaymentCardClient from './service/IssuedPaymentCardClient';

export {
    CardIssuePrice,
    Money,
    Entity,
    createIssuedPaymentCardClient,
    IssuedPaymentCardClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {IssuedPaymentCardClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createIssuedPaymentCardClient(config));
    }

    /**
     * @param {IssuedPaymentCardClient} client
     * @returns {IssuedPaymentCardClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const getCardIssuePriceOriginal = client.getCardIssuePrice.bind(client);
        client.getCardIssuePrice = (...args) => (
            this.$q.when(getCardIssuePriceOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.issued-payment-card-client', [])
    .service('vendorHttpIssuedPaymentCardClientFactory', AngularClientFactory)
    .name;
