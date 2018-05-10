import { RequestFactory, ClientWrapper } from 'paysera-http-client-common';

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
    getUserNaturals(userNaturalFilter) {
        const request = RequestFactory.create(
            'GET',
            'users/natural',
            userNaturalFilter,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserNatural(data);
            })
        ;
    }
    /**
     * Creates Natural user
     * POST /users/natural
     *
     * @param {UserNatural} userNatural
     * @return {Promise.<UserNatural>}
     */
    createNaturalUser(userNatural) {
        const request = RequestFactory.create(
            'POST',
            'users/natural',
            userNatural,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserNatural(data);
            })
        ;
    }

    /**
     * Standard SQL-style Result filtering
     * GET /users/legal
     *
     * @param {UserLegalFilter} userLegalFilter
     * @return {Promise.<UserLegal>}
     */
    getUserLegals(userLegalFilter) {
        const request = RequestFactory.create(
            'GET',
            'users/legal',
            userLegalFilter,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserLegal(data);
            })
        ;
    }
    /**
     * Creates Legal user
     * POST /users/legal
     *
     * @param {UserLegal} userLegal
     * @return {Promise.<UserLegal>}
     */
    createLegalUser(userLegal) {
        const request = RequestFactory.create(
            'POST',
            'users/legal',
            userLegal,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserLegal(data);
            })
        ;
    }

    /**
     * Standard SQL-style Result filtering
     * GET /users
     *
     * @param {UserFilter} userFilter
     * @return {Promise.<array>}
     */
    getUsers(userFilter) {
        const request = RequestFactory.create(
            'GET',
            'users',
            userFilter,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return null;
            })
        ;
    }
    /**
     * Creates Basic user
     * POST /users
     *
     * @param {UserBasic} userBasic
     * @return {Promise.<UserBasic>}
     */
    createUser(userBasic) {
        const request = RequestFactory.create(
            'POST',
            'users',
            userBasic,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserBasic(data);
            })
        ;
    }

}

export default InheritanceClient;
