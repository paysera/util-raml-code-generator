import { ClientFactoryBase, ClientWrapper, TokenProvider } from 'paysera-http-client-common';
import UserInfoClient from './UserInfoClient';

class ClientFactory extends ClientFactoryBase {

    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        super();
        this.client = client;
    }

    /**
     * @param {object|null} options
     * @returns {ClientFactory}
     */
    static create(options = null) {
        return new ClientFactory(this.prototype.getClient(options || {}));
    }

    /**
     * @returns {string}
     */
    static getBaseUrl() {
        return 'https://example.com/user/rest/v1/';
    }

    /**
     * @param {TokenProvider} provider
     *
     * @returns {UserInfoClient}
     */
    getUserInfoClient(provider) {
        this.client.setTokenProvider(provider);
        return new UserInfoClient(this.client);
    }
}

export default ClientFactory;
