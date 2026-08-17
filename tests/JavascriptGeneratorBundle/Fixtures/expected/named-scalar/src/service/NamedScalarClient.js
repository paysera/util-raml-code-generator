import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import CurrencyResult from '../entity/CurrencyResult';
import Payment from '../entity/Payment';

class NamedScalarClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Create payment
     * POST /payments
     *
     * @param {Payment} payment
     * @return {Promise.<Payment>}
     */
    createPayment(payment) {
        const request = createRequest(
            'POST',
            `payments`,
            payment,
        );

        return this.client
            .performRequest(request)
            .then(data => new Payment(data));
    }

    /**
     * List currencies
     * GET /currencies
     *
     * @return {Promise.<CurrencyResult>}
     */
    getCurrencies() {
        const request = createRequest(
            'GET',
            `currencies`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new CurrencyResult(data, 'currencies'));
    }

}

export default NamedScalarClient;
