import { Filter } from '@paysera/http-client-common';

class AccountFilter extends Filter {
    /**
     * @return {string}|null
     */
    getType() {
        return this.get('type');
    }

    /**
     * @param {string} type
     */
    setType(type) {
        this.set('type', type);
    }

    /**
     * @return {Number}|null
     */
    getAdministeredByUserId() {
        return this.get('administered_by_user_id');
    }

    /**
     * @param {Number} administeredByUserId
     */
    setAdministeredByUserId(administeredByUserId) {
        this.set('administered_by_user_id', administeredByUserId);
    }

    /**
     * @return {Number}|null
     */
    getOwnedByUserId() {
        return this.get('owned_by_user_id');
    }

    /**
     * @param {Number} ownedByUserId
     */
    setOwnedByUserId(ownedByUserId) {
        this.set('owned_by_user_id', ownedByUserId);
    }

    /**
     * @return {boolean}|null
     */
    isClosed() {
        return this.get('closed');
    }

    /**
     * @param {boolean} closed
     */
    setClosed(closed) {
        this.set('closed', closed);
    }

    /**
     * @return {Number}|null
     */
    getReadableByClientId() {
        return this.get('readable_by_client_id');
    }

    /**
     * @param {Number} readableByClientId
     */
    setReadableByClientId(readableByClientId) {
        this.set('readable_by_client_id', readableByClientId);
    }

    /**
     * @return {boolean}|null
     */
    isActive() {
        return this.get('active');
    }

    /**
     * @param {boolean} active
     */
    setActive(active) {
        this.set('active', active);
    }
}

export default AccountFilter;
