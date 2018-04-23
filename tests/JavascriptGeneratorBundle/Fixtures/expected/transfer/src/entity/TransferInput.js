import { Entity } from 'paysera-http-client-common';

import Money from '../entity/Money';
import TransferBeneficiary from '../entity/TransferBeneficiary';
import Payer from '../entity/Payer';
import FinalBeneficiary from '../entity/FinalBeneficiary';
import TransferNotifications from '../entity/TransferNotifications';
import TransferPurpose from '../entity/TransferPurpose';
import TransferPassword34 from '../entity/TransferPassword34';
import DateFactory from '../service/DateFactory';

class TransferInput extends Entity {
    constructor(data = []) {
        super(data);
    }

    /**
     * @return {Money}
     */
    getAmount() {
        return new Money(this.get('amount'));
    }

    /**
     * @param {Money} amount
     */
    setAmount(amount) {
        this.set('amount', amount.data);
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
        this.set('beneficiary', beneficiary.data);
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
        this.set('payer', payer.data);
    }

    /**
     * @return {FinalBeneficiary}|null
     */
    getFinalBeneficiary() {
        return new FinalBeneficiary(this.get('final_beneficiary'));
    }

    /**
     * @param {FinalBeneficiary} finalBeneficiary
     */
    setFinalBeneficiary(finalBeneficiary) {
        this.set('final_beneficiary', finalBeneficiary.data);
    }

    /**
     * @return {Date}|null
     */
    getPerformAt() {
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
        return new TransferNotifications(this.get('notifications'));
    }

    /**
     * @param {TransferNotifications} notifications
     */
    setNotifications(notifications) {
        this.set('notifications', notifications.data);
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
        this.set('purpose', purpose.data);
    }

    /**
     * @return {TransferPassword34}|null
     */
    getPassword() {
        return new TransferPassword34(this.get('password'));
    }

    /**
     * @param {TransferPassword34} password
     */
    setPassword(password) {
        this.set('password', password.data);
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
