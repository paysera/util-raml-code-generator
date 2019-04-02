import { Entity } from '@paysera/http-client-common';

class TransferFailureStatus extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string|null}
     */
    getCode() {
        return this.get('code');
    }

    /**
     * @param {string} code
     */
    setCode(code) {
        this.set('code', code);
    }

    /**
     * @return {string|null}
     */
    getMessage() {
        return this.get('message');
    }

    /**
     * @param {string} message
     */
    setMessage(message) {
        this.set('message', message);
    }
}

export default TransferFailureStatus;
