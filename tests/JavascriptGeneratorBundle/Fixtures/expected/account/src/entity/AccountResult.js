import { Result } from 'paysera-http-client-common';

import Account from './Account';

class AccountResult extends Result {

    /**
     * @param {Array} data
     * @returns {Account}
     */
    createItem(data) {
        return new Account(data);
    }
}

export default AccountResult;
