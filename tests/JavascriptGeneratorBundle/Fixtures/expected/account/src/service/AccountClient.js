import { RequestFactory } from 'paysera-http-client-common';

import AccountResult from '../entity/AccountResult';
import Account from '../entity/Account';
import Filter from '../entity/Filter';
import AccountFilter from '../entity/AccountFilter';

class AccountClient {

    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
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
