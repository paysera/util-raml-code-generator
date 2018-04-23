import { RequestFactory, ClientWrapper } from 'paysera-http-client-common';

import UserInfo from '../entity/UserInfo';
import Legal from '../entity/Legal';
import Natural from '../entity/Natural';

class UserInfoClient {

    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
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
