import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import CardIssuePrice from '../entity/CardIssuePrice';

class IssuedPaymentCardClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Price by payer country, client type and card owner id
     * GET /card-issue-price/{country}/{clientType}/{cardOwnerId}
     *
     * @param {string} country
     * @param {string} clientType
     * @param {string} cardOwnerId
     * @return {Promise.<CardIssuePrice>}
     */
    getCardIssuePrice(country, clientType, cardOwnerId) {
        const request = createRequest(
            'GET',
            `card-issue-price/${encodeURIComponent(country)}/${encodeURIComponent(clientType)}/${encodeURIComponent(cardOwnerId)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new CardIssuePrice(data));
    }


}

export default IssuedPaymentCardClient;
