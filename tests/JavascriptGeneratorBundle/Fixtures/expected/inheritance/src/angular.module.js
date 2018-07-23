import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import { Filter } from '@paysera/http-client-common';
import User from './entity/User';
import UserBasic from './entity/UserBasic';
import UserFilter from './entity/UserFilter';
import UserLegal from './entity/UserLegal';
import UserLegalFilter from './entity/UserLegalFilter';
import UserNatural from './entity/UserNatural';
import UserNaturalFilter from './entity/UserNaturalFilter';
import { Entity } from '@paysera/http-client-common';

import { createInheritanceClient } from './service/createClient';
import InheritanceClient from './service/InheritanceClient';

export {
    Filter,
    User,
    UserBasic,
    UserFilter,
    UserLegal,
    UserLegalFilter,
    UserNatural,
    UserNaturalFilter,
    Entity,
    createInheritanceClient,
    InheritanceClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {InheritanceClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createInheritanceClient(config));
    }

    /**
     * @param {InheritanceClient} client
     * @returns {InheritanceClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const getUserNaturalOriginal = client.getUserNatural.bind(client);
        client.getUserNatural = (...args) => (
            this.$q.when(getUserNaturalOriginal(...args))
        );
        const createNaturalUserOriginal = client.createNaturalUser.bind(client);
        client.createNaturalUser = (...args) => (
            this.$q.when(createNaturalUserOriginal(...args))
        );
        const getUserLegalOriginal = client.getUserLegal.bind(client);
        client.getUserLegal = (...args) => (
            this.$q.when(getUserLegalOriginal(...args))
        );
        const createLegalUserOriginal = client.createLegalUser.bind(client);
        client.createLegalUser = (...args) => (
            this.$q.when(createLegalUserOriginal(...args))
        );
        const getUsersOriginal = client.getUsers.bind(client);
        client.getUsers = (...args) => (
            this.$q.when(getUsersOriginal(...args))
        );
        const createUserOriginal = client.createUser.bind(client);
        client.createUser = (...args) => (
            this.$q.when(createUserOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.inheritance-client', [])
    .service('vendorHttpInheritanceClientFactory', AngularClientFactory)
    .name;
