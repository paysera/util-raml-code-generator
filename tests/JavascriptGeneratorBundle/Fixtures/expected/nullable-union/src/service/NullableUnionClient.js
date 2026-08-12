import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import Order from '../entity/Order';

class NullableUnionClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Create order
     * POST /orders
     *
     * @param {Order} order
     * @return {Promise.<Order>}
     */
    createOrder(order) {
        const request = createRequest(
            'POST',
            `orders`,
            order,
        );

        return this.client
            .performRequest(request)
            .then(data => new Order(data));
    }

}

export default NullableUnionClient;
