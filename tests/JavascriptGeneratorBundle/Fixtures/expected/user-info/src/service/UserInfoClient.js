import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import Legal from '../entity/Legal';
import Natural from '../entity/Natural';
import { File } from '@paysera/http-client-common';
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
        const request = createRequest(
            'POST',
            `users/legal`,
            legal,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

    /**
     * Creates Natural User
     * POST /users/natural
     *
     * @param {Natural} natural
     * @return {Promise.<null>}
     */
    createNaturalUser(natural) {
        const request = createRequest(
            'POST',
            `users/natural`,
            natural,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

    /**
     * Get user avatar by it's id
     * GET /users/{id}/avatar
     *
     * @param {string} id
     * @return {Promise.<File>}
     */
    getUserAvatar(id) {
        const request = createRequest(
            'GET',
            `users/${encodeURIComponent(id)}/avatar`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new File(data));
    }

    /**
     * Get user by it's id
     * GET /users/{id}/information
     *
     * @param {string} id
     * @return {Promise.<UserInfo>}
     */
    getUserInformation(id) {
        const request = createRequest(
            'GET',
            `users/${encodeURIComponent(id)}/information`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserInfo(data));
    }
    /**
     * Updates user resource
     * PUT /users/{id}/information
     *
     * @param {string} id
     * @param {UserInfo} userInfo
     * @return {Promise.<UserInfo>}
     */
    updateUserInformation(id, userInfo) {
        const request = createRequest(
            'PUT',
            `users/${encodeURIComponent(id)}/information`,
            userInfo,
        );

        return this.client
            .performRequest(request)
            .then(data => new UserInfo(data));
    }



}

export default UserInfoClient;
