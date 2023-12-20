import { createRequest, ClientWrapper } from '@paysera/http-client-common';


class PackageVersionClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

}

export default PackageVersionClient;
