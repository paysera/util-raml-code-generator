import angular from 'angular';
import { TokenProvider, Scope } from 'paysera-http-client-common';

import TransfersBatchResult from './entity/TransfersBatchResult';
import TransfersBatch from './entity/TransfersBatch';
import TransferRegistrationParameters from './entity/TransferRegistrationParameters';
import ConvertCurrency from './entity/ConvertCurrency';
import TransferPassword from './entity/TransferPassword';
import TransferInput from './entity/TransferInput';
import Money from './entity/Money';
import TransferBeneficiary from './entity/TransferBeneficiary';
import Identifiers from './entity/Identifiers';
import BankAccount from './entity/BankAccount';
import Address from './entity/Address';
import CorrespondentBank from './entity/CorrespondentBank';
import TaxAccount from './entity/TaxAccount';
import PayseraAccount from './entity/PayseraAccount';
import PayzaAccount from './entity/PayzaAccount';
import WebmoneyAccount from './entity/WebmoneyAccount';
import Payer from './entity/Payer';
import FinalBeneficiary from './entity/FinalBeneficiary';
import TransferNotifications from './entity/TransferNotifications';
import TransferNotifcation from './entity/TransferNotifcation';
import TransferPurpose from './entity/TransferPurpose';
import DetailsOptions from './entity/DetailsOptions';
import TransferPassword34 from './entity/TransferPassword34';
import TransferOutput from './entity/TransferOutput';
import TransferInitiator from './entity/TransferInitiator';
import TransferFailureStatus from './entity/TransferFailureStatus';
import TransferAdditionalData from './entity/TransferAdditionalData';
import OutCommissionRule from './entity/OutCommissionRule';
import TransfersFilter from './entity/TransfersFilter';
import FilteredTransfersResult from './entity/FilteredTransfersResult';

import DateFactory from './service/DateFactory';
import ClientFactory from './service/ClientFactory';
import TransferClient from './service/TransferClient';

export {
    TransfersBatchResult,
    TransfersBatch,
    TransferRegistrationParameters,
    ConvertCurrency,
    TransferPassword,
    TransferInput,
    Money,
    TransferBeneficiary,
    Identifiers,
    BankAccount,
    Address,
    CorrespondentBank,
    TaxAccount,
    PayseraAccount,
    PayzaAccount,
    WebmoneyAccount,
    Payer,
    FinalBeneficiary,
    TransferNotifications,
    TransferNotifcation,
    TransferPurpose,
    DetailsOptions,
    TransferPassword34,
    TransferOutput,
    TransferInitiator,
    TransferFailureStatus,
    TransferAdditionalData,
    OutCommissionRule,
    TransfersFilter,
    FilteredTransfersResult,
    DateFactory,
    ClientFactory,
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
    getClient(config) {
        const factoryConfig = {};
        let tokenProvider = null;

        if (config && config.scope && config.initialTokenProvider) {
            tokenProvider = new TokenProvider(
                new Scope(config.scope),
                config.initialTokenProvider,
            );
        }

        if (config && config.baseUrl) {
            factoryConfig.baseUrl = config.baseUrl;
        }

        if (config && config.refreshTokenProvider) {
            factoryConfig.refreshTokenProvider = config.refreshTokenProvider;
        }

        return this.wrapQ(
            ClientFactory.create(factoryConfig).getTransferClient(tokenProvider)
        );
    }

    /**
     * @param {TransferClient} client
     * @returns {TransferClient}
     */
    wrapQ(client) {
        const signTransferOriginal = client.signTransfer.bind(client);
        client.signTransfer = (...args) => {
            return this.$q.when(signTransferOriginal(...args));
        }
        const reserveTransferOriginal = client.reserveTransfer.bind(client);
        client.reserveTransfer = (...args) => {
            return this.$q.when(reserveTransferOriginal(...args));
        }
        const provideTransferPasswordOriginal = client.provideTransferPassword.bind(client);
        client.provideTransferPassword = (...args) => {
            return this.$q.when(provideTransferPasswordOriginal(...args));
        }
        const freezeTransferOriginal = client.freezeTransfer.bind(client);
        client.freezeTransfer = (...args) => {
            return this.$q.when(freezeTransferOriginal(...args));
        }
        const completeTransferOriginal = client.completeTransfer.bind(client);
        client.completeTransfer = (...args) => {
            return this.$q.when(completeTransferOriginal(...args));
        }
        const registerTransferOriginal = client.registerTransfer.bind(client);
        client.registerTransfer = (...args) => {
            return this.$q.when(registerTransferOriginal(...args));
        }
        const getTransferOriginal = client.getTransfer.bind(client);
        client.getTransfer = (...args) => {
            return this.$q.when(getTransferOriginal(...args));
        }
        const deleteTransferOriginal = client.deleteTransfer.bind(client);
        client.deleteTransfer = (...args) => {
            return this.$q.when(deleteTransferOriginal(...args));
        }
        const createTransferOriginal = client.createTransfer.bind(client);
        client.createTransfer = (...args) => {
            return this.$q.when(createTransferOriginal(...args));
        }
        const reserveTransfersOriginal = client.reserveTransfers.bind(client);
        client.reserveTransfers = (...args) => {
            return this.$q.when(reserveTransfersOriginal(...args));
        }
        const getTransfersOriginal = client.getTransfers.bind(client);
        client.getTransfers = (...args) => {
            return this.$q.when(getTransfersOriginal(...args));
        }

        return client;
    }
}

AngularClientFactory.$inject = ['$q'];

export default angular
    .module('vendor.http.transfer', [])
    .service('vendorHttpTransferClientFactory', AngularClientFactory)
    .name
;
