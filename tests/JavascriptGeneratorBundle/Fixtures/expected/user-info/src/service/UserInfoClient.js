import { RequestFactory, ClientWrapper } from 'paysera-http-client-common';

import Legal from '../entity/Legal';
import Natural from '../entity/Natural';
import UserInfo from '../entity/UserInfo';

class UserInfoClient {

    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Creates Legal User
     * POST /users/legal
     *
     * @param {Legal} legal
     * @return {Promise.<null>}
     */
    createLegalUser(legal) {
        const request = RequestFactory.create(
            'POST',
            'users/legal',
            legal,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return null;
            })
        ;
    }

    /**
     * Creates Natural User
     * POST /users/natural
     *
     * @param {Natural} natural
     * @return {Promise.<null>}
     */
    createNaturalUser(natural) {
        const request = RequestFactory.create(
            'POST',
            'users/natural',
            natural,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return null;
            })
        ;
    }

    /**
     * Get user by it's id
     * GET /users/{id}/information
     *
     * @param {string} id
     * @return {Promise.<UserInfo>}
     */
    getUserInformation(id) {
        const request = RequestFactory.create(
            'GET',
            'users/' + encodeURIComponent(id) + '/information',
            null,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserInfo(data);
            })
        ;
    }
    /**
     * Updates user resource
     * PUT /users/{id}/information
     *
     * @param {string} id
     * @param {UserInfo} userInfo
     * @return {Promise.<UserInfo>}
     */
    informationUser(id, userInfo) {
        const request = RequestFactory.create(
            'PUT',
            'users/' + encodeURIComponent(id) + '/information',
            userInfo,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new UserInfo(data);
            })
        ;
    }



}

export default UserInfoClient;
