import { createRequest, ClientWrapper } from '@paysera/http-client-common';


class PlatformVersionClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

}

export default PlatformVersionClient;
