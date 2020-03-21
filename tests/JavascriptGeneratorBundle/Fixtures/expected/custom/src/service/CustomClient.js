import { createRequest, ClientWrapper } from '@paysera/http-client-common';


class CustomClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * 
     * GET /something
     *
     * @return {Promise.<null>}
     */
    customNameForMethod() {
        const request = createRequest(
            'GET',
            `something`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

}

export default CustomClient;
