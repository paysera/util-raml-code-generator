import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import Account from './entity/Account';
import AccountFilter from './entity/AccountFilter';
import AccountResult from './entity/AccountResult';
import { Filter } from '@paysera/http-client-common';
import { Result } from '@paysera/http-client-common';
import UndescribedType from './entity/UndescribedType';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

import { createAccountClient } from './service/createClient';
import AccountClient from './service/AccountClient';

export {
    Account,
    AccountFilter,
    AccountResult,
    Filter,
    Result,
    UndescribedType,
    DateTime,
    Entity,
    createAccountClient,
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
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createAccountClient(config));
    }

    /**
     * @param {AccountClient} client
     * @returns {AccountClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const getAccountScriptsOriginal = client.getAccountScripts.bind(client);
        client.getAccountScripts = (...args) => (
            this.$q.when(getAccountScriptsOriginal(...args))
        );
        const getAccountsOriginal = client.getAccounts.bind(client);
        client.getAccounts = (...args) => (
            this.$q.when(getAccountsOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.account-client', [])
    .service('vendorHttpAccountClientFactory', AngularClientFactory)
    .name;
