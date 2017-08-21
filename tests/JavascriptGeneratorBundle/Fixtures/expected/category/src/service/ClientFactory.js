import { ClientFactoryBase } from 'paysera-http-client-common';
import CategoryClient from './CategoryClient';

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
        return 'https://my-api.example.com/rest/v1/';
    }

    /**
     * @param {TokenProvider} provider
     *
     * @returns {CategoryClient}
     */
    getCategoryClient(provider) {
        this.client.setTokenProvider(provider);
        return new CategoryClient(this.client);
    }
}

export default ClientFactory;
