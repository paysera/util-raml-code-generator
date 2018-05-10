import Account from './Account';
import { Result } from 'paysera-http-client-common';

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
