import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

class UserInfo extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getId() {
        return this.get('id');
    }

    /**
     * @param {string} id
     */
    setId(id) {
        this.set('id', id);
    }

    /**
     * @return {string}
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
     * @return {DateTime}
     */
    getCreatedTimestamp() {
        return DateTime.fromMillis(this.get('created_timestamp') * 1000);
    }

    /**
     * @param {DateTime} createdTimestamp
     */
    setCreatedTimestamp(createdTimestamp) {
        this.set('created_timestamp', Math.floor(createdTimestamp.toMillis()/1000));
    }

    /**
     * @return {DateTime}|null
     */
    getCreatedDatetime() {
        if (this.get('created_datetime') == null) {
            return null;
        }
        return DateTime.fromFormat(this.get('created_datetime'), "yyyy-MM-dd'T'HH:mm:ssZZ");
    }

    /**
     * @param {DateTime} createdDatetime
     */
    setCreatedDatetime(createdDatetime) {
        this.set('created_datetime', createdDatetime.toFormat("yyyy-MM-dd'T'HH:mm:ssZZ"));
    }

    /**
     * @return {DateTime}|null
     */
    getCreatedDateOnly() {
        if (this.get('created_date_only') == null) {
            return null;
        }
        return DateTime.fromFormat(this.get('created_date_only'), "yyyy-MM-dd");
    }

    /**
     * @param {DateTime} createdDateOnly
     */
    setCreatedDateOnly(createdDateOnly) {
        this.set('created_date_only', createdDateOnly.toFormat("yyyy-MM-dd"));
    }

    /**
     * @return {DateTime}|null
     */
    getCreatedTimeOnly() {
        if (this.get('created_time_only') == null) {
            return null;
        }
        return DateTime.fromFormat(this.get('created_time_only'), "HH:mm:ss");
    }

    /**
     * @param {DateTime} createdTimeOnly
     */
    setCreatedTimeOnly(createdTimeOnly) {
        this.set('created_time_only', createdTimeOnly.toFormat("HH:mm:ss"));
    }

    /**
     * @return {DateTime}|null
     */
    getCreatedDatetimeOnly() {
        if (this.get('created_datetime_only') == null) {
            return null;
        }
        return DateTime.fromFormat(this.get('created_datetime_only'), "yyyy-MM-dd'T'HH:mm:ss");
    }

    /**
     * @param {DateTime} createdDatetimeOnly
     */
    setCreatedDatetimeOnly(createdDatetimeOnly) {
        this.set('created_datetime_only', createdDatetimeOnly.toFormat("yyyy-MM-dd'T'HH:mm:ss"));
    }
}

export default UserInfo;
