import FinalBeneficiary from './FinalBeneficiary';
import Payer from './Payer';
import { Money } from '@paysera/money';
import TransferBeneficiary from './TransferBeneficiary';
import TransferNotifications from './TransferNotifications';
import TransferPassword34 from './TransferPassword34';
import TransferPurpose from './TransferPurpose';
import { Entity } from 'paysera-http-client-common';

import DateFactory from '../service/DateFactory';

class TransferInput extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {Money}
     */
    getAmount() {
        return new Money(this.get('amount')['amount'], this.get('amount')['currency']);
    }

    /**
     * @param {Money} amount
     */
    setAmount(amount) {
        this.set('amount', {'amount':amount.getAmount(), 'currency':amount.getCurrency()});
    }

    /**
     * @return {TransferBeneficiary}
     */
    getBeneficiary() {
        return new TransferBeneficiary(this.get('beneficiary'));
    }

    /**
     * @param {TransferBeneficiary} beneficiary
     */
    setBeneficiary(beneficiary) {
        this.set('beneficiary', beneficiary.getData());
    }

    /**
     * @return {Payer}
     */
    getPayer() {
        return new Payer(this.get('payer'));
    }

    /**
     * @param {Payer} payer
     */
    setPayer(payer) {
        this.set('payer', payer.getData());
    }

    /**
     * @return {FinalBeneficiary}|null
     */
    getFinalBeneficiary() {
        if (this.get('final_beneficiary') == null) {
            return null;
        }
        return new FinalBeneficiary(this.get('final_beneficiary'));
    }

    /**
     * @param {FinalBeneficiary} finalBeneficiary
     */
    setFinalBeneficiary(finalBeneficiary) {
        this.set('final_beneficiary', finalBeneficiary.getData());
    }

    /**
     * @return {Date}|null
     */
    getPerformAt() {
        if (this.get('perform_at') == null) {
            return null;
        }
        return DateFactory.create(this.get('perform_at'));
    }

    /**
     * @param {Date} performAt
     */
    setPerformAt(performAt) {
        this.set('perform_at', performAt.getTime());
    }

    /**
     * @return {string}|null
     */
    getChargeType() {
        return this.get('charge_type');
    }

    /**
     * @param {string} chargeType
     */
    setChargeType(chargeType) {
        this.set('charge_type', chargeType);
    }

    /**
     * @return {string}|null
     */
    getUrgency() {
        return this.get('urgency');
    }

    /**
     * @param {string} urgency
     */
    setUrgency(urgency) {
        this.set('urgency', urgency);
    }

    /**
     * @return {TransferNotifications}|null
     */
    getNotifications() {
        if (this.get('notifications') == null) {
            return null;
        }
        return new TransferNotifications(this.get('notifications'));
    }

    /**
     * @param {TransferNotifications} notifications
     */
    setNotifications(notifications) {
        this.set('notifications', notifications.getData());
    }

    /**
     * @return {TransferPurpose}
     */
    getPurpose() {
        return new TransferPurpose(this.get('purpose'));
    }

    /**
     * @param {TransferPurpose} purpose
     */
    setPurpose(purpose) {
        this.set('purpose', purpose.getData());
    }

    /**
     * @return {TransferPassword34}|null
     */
    getPassword() {
        if (this.get('password') == null) {
            return null;
        }
        return new TransferPassword34(this.get('password'));
    }

    /**
     * @param {TransferPassword34} password
     */
    setPassword(password) {
        this.set('password', password.getData());
    }

    /**
     * @return {boolean}|null
     */
    isCancelable() {
        return this.get('cancelable');
    }

    /**
     * @param {boolean} cancelable
     */
    setCancelable(cancelable) {
        this.set('cancelable', cancelable);
    }

    /**
     * @return {boolean}|null
     */
    isAutoCurrencyConvert() {
        return this.get('auto_currency_convert');
    }

    /**
     * @param {boolean} autoCurrencyConvert
     */
    setAutoCurrencyConvert(autoCurrencyConvert) {
        this.set('auto_currency_convert', autoCurrencyConvert);
    }

    /**
     * @return {boolean}|null
     */
    isAutoChargeRelatedCard() {
        return this.get('auto_charge_related_card');
    }

    /**
     * @param {boolean} autoChargeRelatedCard
     */
    setAutoChargeRelatedCard(autoChargeRelatedCard) {
        this.set('auto_charge_related_card', autoChargeRelatedCard);
    }

    /**
     * @return {Date}|null
     */
    getReserveUntil() {
        if (this.get('reserve_until') == null) {
            return null;
        }
        return DateFactory.create(this.get('reserve_until'));
    }

    /**
     * @param {Date} reserveUntil
     */
    setReserveUntil(reserveUntil) {
        this.set('reserve_until', reserveUntil.getTime());
    }
}

export default TransferInput;
