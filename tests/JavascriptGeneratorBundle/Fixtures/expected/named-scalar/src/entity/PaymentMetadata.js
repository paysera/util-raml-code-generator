import { Entity } from '@paysera/http-client-common';

class PaymentMetadata extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getSource() {
        return this.get('source');
    }

    /**
     * @param {string} source
     */
    setSource(source) {
        this.set('source', source);
    }

    /**
     * @return {string|null}
     */
    getChannel() {
        return this.get('channel');
    }

    /**
     * @param {string} channel
     */
    setChannel(channel) {
        this.set('channel', channel);
    }
}

export default PaymentMetadata;
