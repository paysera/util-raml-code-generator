import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import Inquiry from '../entity/Inquiry';

class NullableTypesClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Get an inquiry
     * GET /inquiries/{id}
     *
     * @param {string} id
     * @return {Promise.<Inquiry>}
     */
    getInquiry(id) {
        const request = createRequest(
            'GET',
            `inquiries/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Inquiry(data));
    }
    /**
     * Update an inquiry
     * PUT /inquiries/{id}
     *
     * @param {string} id
     * @param {Inquiry} inquiry
     * @return {Promise.<Inquiry>}
     */
    updateInquiry(id, inquiry) {
        const request = createRequest(
            'PUT',
            `inquiries/${encodeURIComponent(id)}`,
            inquiry,
        );

        return this.client
            .performRequest(request)
            .then(data => new Inquiry(data));
    }


}

export default NullableTypesClient;
