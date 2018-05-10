import { RequestFactory, ClientWrapper } from 'paysera-http-client-common';

import AccountFilter from '../entity/AccountFilter';
import AccountResult from '../entity/AccountResult';

class AccountClient {

    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Generated JS code
     * GET /accounts/scripts
     *
     * @return {Promise.<string>}
     */
    getAccountScripts() {
        const request = RequestFactory.create(
            'GET',
            'accounts/scripts',
            null,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return data;
            })
        ;
    }

    /**
     * Standard SQL-style Result filtering
     * GET /accounts
     *
     * @param {AccountFilter} accountFilter
     * @return {Promise.<AccountResult>}
     */
    getAccounts(accountFilter) {
        const request = RequestFactory.create(
            'GET',
            'accounts',
            accountFilter,
        );

        return this.client
            .performRequest(request)
            .then((data) => {
                return new AccountResult(data, 'accounts');
            })
        ;
    }

}

export default AccountClient;
