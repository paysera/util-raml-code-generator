import Account from './Account';
import { Result } from '@paysera/http-client-common';

/* eslint class-methods-use-this: ["error", { "exceptMethods": ["createItem"] }] */
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
