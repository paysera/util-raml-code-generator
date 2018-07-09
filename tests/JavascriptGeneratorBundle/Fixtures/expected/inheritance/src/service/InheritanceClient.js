import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import UserBasic from '../entity/UserBasic';
import UserFilter from '../entity/UserFilter';
import UserLegal from '../entity/UserLegal';
import UserLegalFilter from '../entity/UserLegalFilter';
import UserNatural from '../entity/UserNatural';
import UserNaturalFilter from '../entity/UserNaturalFilter';

class InheritanceClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * User Natural Filter
     * GET /users/natural
     *
     * @param {UserNaturalFilter} userNaturalFilter
     * @return {Promise.<UserNatural>}
     */
    getUserNatural(userNaturalFilter) {
        const request = createRequest(
            'GET',
            `users/natural`,
            userNaturalFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserNatural(data));
    }
    /**
     * Creates Natural user
     * POST /users/natural
     *
     * @param {UserNatural} userNatural
     * @return {Promise.<UserNatural>}
     */
    createNaturalUser(userNatural) {
        const request = createRequest(
            'POST',
            `users/natural`,
            userNatural,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserNatural(data));
    }

    /**
     * Standard SQL-style Result filtering
     * GET /users/legal
     *
     * @param {UserLegalFilter} userLegalFilter
     * @return {Promise.<UserLegal>}
     */
    getUserLegal(userLegalFilter) {
        const request = createRequest(
            'GET',
            `users/legal`,
            userLegalFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserLegal(data));
    }
    /**
     * Creates Legal user
     * POST /users/legal
     *
     * @param {UserLegal} userLegal
     * @return {Promise.<UserLegal>}
     */
    createLegalUser(userLegal) {
        const request = createRequest(
            'POST',
            `users/legal`,
            userLegal,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserLegal(data));
    }

    /**
     * Standard SQL-style Result filtering
     * GET /users
     *
     * @param {UserFilter} userFilter
     * @return {Promise.<UserBasic[]>}
     */
    getUsers(userFilter) {
        const request = createRequest(
            'GET',
            `users`,
            userFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => data.map(item => new UserBasic(item)));
    }
    /**
     * Creates Basic user
     * POST /users
     *
     * @param {UserBasic} userBasic
     * @return {Promise.<UserBasic>}
     */
    createUser(userBasic) {
        const request = createRequest(
            'POST',
            `users`,
            userBasic,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserBasic(data));
    }

}

export default InheritanceClient;
