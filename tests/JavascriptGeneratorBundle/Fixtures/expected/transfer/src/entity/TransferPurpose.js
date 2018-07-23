import DetailsOptions from './DetailsOptions';
import { Entity } from '@paysera/http-client-common';

class TransferPurpose extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getDetails() {
        return this.get('details');
    }

    /**
     * @param {string} details
     */
    setDetails(details) {
        this.set('details', details);
    }

    /**
     * @return {string}|null
     */
    getReference() {
        return this.get('reference');
    }

    /**
     * @param {string} reference
     */
    setReference(reference) {
        this.set('reference', reference);
    }

    /**
     * @return {string}|null
     */
    getVoCode() {
        return this.get('vo_code');
    }

    /**
     * @param {string} voCode
     */
    setVoCode(voCode) {
        this.set('vo_code', voCode);
    }

    /**
     * @return {string}|null
     */
    getOcrCode() {
        return this.get('ocr_code');
    }

    /**
     * @param {string} ocrCode
     */
    setOcrCode(ocrCode) {
        this.set('ocr_code', ocrCode);
    }

    /**
     * @return {DetailsOptions}|null
     */
    getDetailsOptions() {
        if (this.get('details_options') == null) {
            return null;
        }
        return new DetailsOptions(this.get('details_options'));
    }

    /**
     * @param {DetailsOptions} detailsOptions
     */
    setDetailsOptions(detailsOptions) {
        this.set('details_options', detailsOptions.getData());
    }

    /**
     * @return {string}|null
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
}

export default TransferPurpose;
