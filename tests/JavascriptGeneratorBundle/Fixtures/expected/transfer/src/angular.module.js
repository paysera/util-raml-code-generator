import angular from 'angular';
import { TokenProvider, Scope } from '@paysera/http-client-common';

import Address from './entity/Address';
import BankAccount from './entity/BankAccount';
import ConvertCurrency from './entity/ConvertCurrency';
import CorrespondentBank from './entity/CorrespondentBank';
import DetailsOptions from './entity/DetailsOptions';
import FilteredTransfersResult from './entity/FilteredTransfersResult';
import FinalBeneficiary from './entity/FinalBeneficiary';
import Identifiers from './entity/Identifiers';
import OutCommissionRule from './entity/OutCommissionRule';
import Payer from './entity/Payer';
import { Money } from '@paysera/money';
import { Result } from '@paysera/http-client-common';
import PayseraAccount from './entity/PayseraAccount';
import PayzaAccount from './entity/PayzaAccount';
import TaxAccount from './entity/TaxAccount';
import TransferAdditionalData from './entity/TransferAdditionalData';
import TransferBeneficiary from './entity/TransferBeneficiary';
import TransferFailureStatus from './entity/TransferFailureStatus';
import TransferInitiator from './entity/TransferInitiator';
import TransferInput from './entity/TransferInput';
import TransferNotifcation from './entity/TransferNotifcation';
import TransferNotifications from './entity/TransferNotifications';
import TransferOutput from './entity/TransferOutput';
import TransferPassword from './entity/TransferPassword';
import TransferPassword34 from './entity/TransferPassword34';
import TransferPurpose from './entity/TransferPurpose';
import TransferRegistrationParameters from './entity/TransferRegistrationParameters';
import TransfersBatch from './entity/TransfersBatch';
import TransfersBatchResult from './entity/TransfersBatchResult';
import TransfersFilter from './entity/TransfersFilter';
import WebmoneyAccount from './entity/WebmoneyAccount';
import { Entity } from '@paysera/http-client-common';

import DateFactory from './service/DateFactory';
import { createTransferClient } from './service/createClient';
import TransferClient from './service/TransferClient';

export {
    Address,
    BankAccount,
    ConvertCurrency,
    CorrespondentBank,
    DetailsOptions,
    FilteredTransfersResult,
    FinalBeneficiary,
    Identifiers,
    OutCommissionRule,
    Payer,
    Money,
    Result,
    PayseraAccount,
    PayzaAccount,
    TaxAccount,
    TransferAdditionalData,
    TransferBeneficiary,
    TransferFailureStatus,
    TransferInitiator,
    TransferInput,
    TransferNotifcation,
    TransferNotifications,
    TransferOutput,
    TransferPassword,
    TransferPassword34,
    TransferPurpose,
    TransferRegistrationParameters,
    TransfersBatch,
    TransfersBatchResult,
    TransfersFilter,
    WebmoneyAccount,
    Entity,
    DateFactory,
    createTransferClient,
    TransferClient,
};

class AngularClientFactory {
    constructor($q) {
        this.$q = $q;
    }

    /**
     * @param {object|null} config
     * @returns {TransferClient}
     */
    getClient(config = { baseURL: undefined, middleware: undefined }) {
        return this.wrapQ(createTransferClient(config));
    }

    /**
     * @param {TransferClient} client
     * @returns {TransferClient}
     */
    /* eslint no-param-reassign: ["error", { "props": true, "ignorePropertyModificationsFor": ["client"] }] */
    wrapQ(client) {
        const signTransferOriginal = client.signTransfer.bind(client);
        client.signTransfer = (...args) => (
            this.$q.when(signTransferOriginal(...args))
        );
        const reserveTransferOriginal = client.reserveTransfer.bind(client);
        client.reserveTransfer = (...args) => (
            this.$q.when(reserveTransferOriginal(...args))
        );
        const provideTransferPasswordOriginal = client.provideTransferPassword.bind(client);
        client.provideTransferPassword = (...args) => (
            this.$q.when(provideTransferPasswordOriginal(...args))
        );
        const freezeTransferOriginal = client.freezeTransfer.bind(client);
        client.freezeTransfer = (...args) => (
            this.$q.when(freezeTransferOriginal(...args))
        );
        const completeTransferOriginal = client.completeTransfer.bind(client);
        client.completeTransfer = (...args) => (
            this.$q.when(completeTransferOriginal(...args))
        );
        const registerTransferOriginal = client.registerTransfer.bind(client);
        client.registerTransfer = (...args) => (
            this.$q.when(registerTransferOriginal(...args))
        );
        const getTransferOriginal = client.getTransfer.bind(client);
        client.getTransfer = (...args) => (
            this.$q.when(getTransferOriginal(...args))
        );
        const deleteTransferOriginal = client.deleteTransfer.bind(client);
        client.deleteTransfer = (...args) => (
            this.$q.when(deleteTransferOriginal(...args))
        );
        const reserveTransfersOriginal = client.reserveTransfers.bind(client);
        client.reserveTransfers = (...args) => (
            this.$q.when(reserveTransfersOriginal(...args))
        );
        const getTransfersOriginal = client.getTransfers.bind(client);
        client.getTransfers = (...args) => (
            this.$q.when(getTransfersOriginal(...args))
        );
        const createTransferOriginal = client.createTransfer.bind(client);
        client.createTransfer = (...args) => (
            this.$q.when(createTransferOriginal(...args))
        );

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.transfer-client', [])
    .service('vendorHttpTransferClientFactory', AngularClientFactory)
    .name;
