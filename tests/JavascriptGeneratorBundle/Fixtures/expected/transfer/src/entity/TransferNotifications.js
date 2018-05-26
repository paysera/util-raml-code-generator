import TransferNotifcation from './TransferNotifcation';
import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferNotifications extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {TransferNotifcation}|null
     */
    getDone() {
        if (this.get('done') == null) {
            return null;
        }
        return new TransferNotifcation(this.get('done'));
    }

    /**
     * @param {TransferNotifcation} done
     */
    setDone(done) {
        this.set('done', done.getData());
    }
}

export default TransferNotifications;
