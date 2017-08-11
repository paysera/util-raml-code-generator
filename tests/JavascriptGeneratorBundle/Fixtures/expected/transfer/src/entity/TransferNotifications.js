import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferNotifications extends Entity {

    /**
     * @return {TransferNotifcation}|null
     */
    getDone() {
        return new TransferNotifcation(this.get('done'));
    }

    /**
     * @param {TransferNotifcation} done
     */
    setDone(done) {
        this.set('done', done.data);
    }
}

export default TransferNotifications;
