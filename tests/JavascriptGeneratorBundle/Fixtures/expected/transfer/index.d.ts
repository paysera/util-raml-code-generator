import { Money } from '@paysera/money';
import { Result } from '@paysera/http-client-common';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

export interface AddressProperties {
    country_code: string | null;
    address_line: string | null;
}

declare class Address extends Entity {
    getCountryCode(): string | null;
    setCountryCode(countryCode: string | null): this;
    getAddressLine(): string | null;
    setAddressLine(addressLine: string | null): this;

    getData(): AddressProperties;
}

export interface BankAccountProperties {
    iban: string | null;
    account_number: string | null;
    country_code: string | null;
    bic: string | null;
    bank_code: string | null;
    bank_address: Address | null;
    bank_title: string | null;
    correspondent_bank: CorrespondentBank | null;
}

declare class BankAccount extends Entity {
    getIban(): string | null;
    setIban(iban: string | null): this;
    getAccountNumber(): string | null;
    setAccountNumber(accountNumber: string | null): this;
    getCountryCode(): string | null;
    setCountryCode(countryCode: string | null): this;
    getBic(): string | null;
    setBic(bic: string | null): this;
    getBankCode(): string | null;
    setBankCode(bankCode: string | null): this;
    getBankAddress(): Address | null;
    setBankAddress(bankAddress: Address | null): this;
    getBankTitle(): string | null;
    setBankTitle(bankTitle: string | null): this;
    getCorrespondentBank(): CorrespondentBank | null;
    setCorrespondentBank(correspondentBank: CorrespondentBank | null): this;

    getData(): BankAccountProperties;
}

export interface ConvertCurrencyProperties {
    from_currency: string;
    to_currency: string;
    to_amount: string | null;
    from_amount: string | null;
    min_to_amount: string | null;
    max_from_amount: string | null;
    account_number: string | null;
}

declare class ConvertCurrency extends Entity {
    getFromCurrency(): string;
    setFromCurrency(fromCurrency: string): this;
    getToCurrency(): string;
    setToCurrency(toCurrency: string): this;
    getToAmount(): string | null;
    setToAmount(toAmount: string | null): this;
    getFromAmount(): string | null;
    setFromAmount(fromAmount: string | null): this;
    getMinToAmount(): string | null;
    setMinToAmount(minToAmount: string | null): this;
    getMaxFromAmount(): string | null;
    setMaxFromAmount(maxFromAmount: string | null): this;
    getAccountNumber(): string | null;
    setAccountNumber(accountNumber: string | null): this;

    getData(): ConvertCurrencyProperties;
}

export interface CorrespondentBankProperties {
    bank_title: string | null;
    account_number: string | null;
    bank_code: string | null;
}

declare class CorrespondentBank extends Entity {
    getBankTitle(): string | null;
    setBankTitle(bankTitle: string | null): this;
    getAccountNumber(): string | null;
    setAccountNumber(accountNumber: string | null): this;
    getBankCode(): string | null;
    setBankCode(bankCode: string | null): this;

    getData(): CorrespondentBankProperties;
}

export interface DetailsOptionsProperties {
    preserve: boolean | null;
}

declare class DetailsOptions extends Entity {
    isPreserve(): boolean | null;
    setPreserve(preserve: boolean | null): this;

    getData(): DetailsOptionsProperties;
}

export interface FilteredTransfersResultProperties {
}

declare class FilteredTransfersResult extends Result {

    getData(): FilteredTransfersResultProperties;
}

export interface FinalBeneficiaryProperties {
    name: string | null;
    identifiers: Identifiers | null;
    person_type: string | null;
}

declare class FinalBeneficiary extends Entity {
    getName(): string | null;
    setName(name: string | null): this;
    getIdentifiers(): Identifiers | null;
    setIdentifiers(identifiers: Identifiers | null): this;
    getPersonType(): string | null;
    setPersonType(personType: string | null): this;

    getData(): FinalBeneficiaryProperties;
}

export interface IdentifiersProperties {
    general: string | null;
    personal_code: string | null;
    legal_code: string | null;
    tax_code: string | null;
    kpp_code: string | null;
}

declare class Identifiers extends Entity {
    getGeneral(): string | null;
    setGeneral(general: string | null): this;
    getPersonalCode(): string | null;
    setPersonalCode(personalCode: string | null): this;
    getLegalCode(): string | null;
    setLegalCode(legalCode: string | null): this;
    getTaxCode(): string | null;
    setTaxCode(taxCode: string | null): this;
    getKppCode(): string | null;
    setKppCode(kppCode: string | null): this;

    getData(): IdentifiersProperties;
}

export interface OutCommissionRuleProperties {
    percent: string | null;
    min: Money | null;
    max: Money | null;
    fix: Money | null;
}

declare class OutCommissionRule extends Entity {
    getPercent(): string | null;
    setPercent(percent: string | null): this;
    getMin(): Money | null;
    setMin(min: Money | null): this;
    getMax(): Money | null;
    setMax(max: Money | null): this;
    getFix(): Money | null;
    setFix(fix: Money | null): this;

    getData(): OutCommissionRuleProperties;
}

export interface PayerProperties {
    account_number: string;
    reference: string | null;
}

declare class Payer extends Entity {
    getAccountNumber(): string;
    setAccountNumber(accountNumber: string): this;
    getReference(): string | null;
    setReference(reference: string | null): this;

    getData(): PayerProperties;
}

export interface PayseraAccountProperties {
    account_number: string | null;
    email: string | null;
    phone: string | null;
}

declare class PayseraAccount extends Entity {
    getAccountNumber(): string | null;
    setAccountNumber(accountNumber: string | null): this;
    getEmail(): string | null;
    setEmail(email: string | null): this;
    getPhone(): string | null;
    setPhone(phone: string | null): this;

    getData(): PayseraAccountProperties;
}

export interface PayzaAccountProperties {
    email: string;
}

declare class PayzaAccount extends Entity {
    getEmail(): string;
    setEmail(email: string): this;

    getData(): PayzaAccountProperties;
}

export interface TaxAccountProperties {
    identifier: string;
}

declare class TaxAccount extends Entity {
    getIdentifier(): string;
    setIdentifier(identifier: string): this;

    getData(): TaxAccountProperties;
}

export interface TransferAdditionalDataProperties {
    estimated_processing_date: bigint | null;
    out_commission_rule: OutCommissionRule | null;
    original_out_commission: Money | null;
    correspondent_bank_fees_may_apply: boolean | null;
}

declare class TransferAdditionalData extends Entity {
    getEstimatedProcessingDate(): bigint | null;
    setEstimatedProcessingDate(estimatedProcessingDate: bigint | null): this;
    getOutCommissionRule(): OutCommissionRule | null;
    setOutCommissionRule(outCommissionRule: OutCommissionRule | null): this;
    getOriginalOutCommission(): Money | null;
    setOriginalOutCommission(originalOutCommission: Money | null): this;
    isCorrespondentBankFeesMayApply(): boolean | null;
    setCorrespondentBankFeesMayApply(correspondentBankFeesMayApply: boolean | null): this;

    getData(): TransferAdditionalDataProperties;
}

export interface TransferBeneficiaryProperties {
    type: string;
    identifiers: Identifiers | null;
    name: string;
    person_type: string | null;
    bank_account: BankAccount | null;
    tax_account: TaxAccount | null;
    paysera_account: PayseraAccount | null;
    payza_account: PayzaAccount | null;
    webmoney_account: WebmoneyAccount | null;
}

declare class TransferBeneficiary extends Entity {
    getType(): string;
    setType(type: string): this;
    getIdentifiers(): Identifiers | null;
    setIdentifiers(identifiers: Identifiers | null): this;
    getName(): string;
    setName(name: string): this;
    getPersonType(): string | null;
    setPersonType(personType: string | null): this;
    getBankAccount(): BankAccount | null;
    setBankAccount(bankAccount: BankAccount | null): this;
    getTaxAccount(): TaxAccount | null;
    setTaxAccount(taxAccount: TaxAccount | null): this;
    getPayseraAccount(): PayseraAccount | null;
    setPayseraAccount(payseraAccount: PayseraAccount | null): this;
    getPayzaAccount(): PayzaAccount | null;
    setPayzaAccount(payzaAccount: PayzaAccount | null): this;
    getWebmoneyAccount(): WebmoneyAccount | null;
    setWebmoneyAccount(webmoneyAccount: WebmoneyAccount | null): this;

    getData(): TransferBeneficiaryProperties;
}

export interface TransferFailureStatusProperties {
    code: string | null;
    message: string | null;
}

declare class TransferFailureStatus extends Entity {
    getCode(): string | null;
    setCode(code: string | null): this;
    getMessage(): string | null;
    setMessage(message: string | null): this;

    getData(): TransferFailureStatusProperties;
}

export interface TransferInitiatorProperties {
    user_id: string | null;
    client_id: string | null;
}

declare class TransferInitiator extends Entity {
    getUserId(): string | null;
    setUserId(userId: string | null): this;
    getClientId(): string | null;
    setClientId(clientId: string | null): this;

    getData(): TransferInitiatorProperties;
}

export interface TransferInputProperties {
    amount: Money;
    beneficiary: TransferBeneficiary;
    payer: Payer;
    final_beneficiary: FinalBeneficiary | null;
    perform_at: bigint | null;
    charge_type: string | null;
    urgency: string | null;
    notifications: TransferNotifications | null;
    purpose: TransferPurpose;
    password: TransferPassword34 | null;
    cancelable: boolean | null;
    auto_currency_convert: boolean | null;
    auto_charge_related_card: boolean | null;
    reserve_until: bigint | null;
}

declare class TransferInput extends Entity {
    getAmount(): Money;
    setAmount(amount: Money): this;
    getBeneficiary(): TransferBeneficiary;
    setBeneficiary(beneficiary: TransferBeneficiary): this;
    getPayer(): Payer;
    setPayer(payer: Payer): this;
    getFinalBeneficiary(): FinalBeneficiary | null;
    setFinalBeneficiary(finalBeneficiary: FinalBeneficiary | null): this;
    getPerformAt(): bigint | null;
    setPerformAt(performAt: bigint | null): this;
    getChargeType(): string | null;
    setChargeType(chargeType: string | null): this;
    getUrgency(): string | null;
    setUrgency(urgency: string | null): this;
    getNotifications(): TransferNotifications | null;
    setNotifications(notifications: TransferNotifications | null): this;
    getPurpose(): TransferPurpose;
    setPurpose(purpose: TransferPurpose): this;
    getPassword(): TransferPassword34 | null;
    setPassword(password: TransferPassword34 | null): this;
    isCancelable(): boolean | null;
    setCancelable(cancelable: boolean | null): this;
    isAutoCurrencyConvert(): boolean | null;
    setAutoCurrencyConvert(autoCurrencyConvert: boolean | null): this;
    isAutoChargeRelatedCard(): boolean | null;
    setAutoChargeRelatedCard(autoChargeRelatedCard: boolean | null): this;
    getReserveUntil(): bigint | null;
    setReserveUntil(reserveUntil: bigint | null): this;

    getData(): TransferInputProperties;
}

export interface TransferNotifcationProperties {
    locale: string;
    email: string;
}

declare class TransferNotifcation extends Entity {
    getLocale(): string;
    setLocale(locale: string): this;
    getEmail(): string;
    setEmail(email: string): this;

    getData(): TransferNotifcationProperties;
}

export interface TransferNotificationsProperties {
    done: TransferNotifcation | null;
}

declare class TransferNotifications extends Entity {
    getDone(): TransferNotifcation | null;
    setDone(done: TransferNotifcation | null): this;

    getData(): TransferNotificationsProperties;
}

export interface TransferOutputProperties extends TransferInputProperties {
    id: string;
    status: string;
    initiator: TransferInitiator;
    created_at: bigint;
    performed_at: bigint | null;
    failure_status: TransferFailureStatus | null;
    out_commission: Money | null;
    additional_information: TransferAdditionalData | null;
}

declare class TransferOutput extends TransferInput {
    getId(): string;
    setId(id: string): this;
    getStatus(): string;
    setStatus(status: string): this;
    getInitiator(): TransferInitiator;
    setInitiator(initiator: TransferInitiator): this;
    getCreatedAt(): bigint;
    setCreatedAt(createdAt: bigint): this;
    getPerformedAt(): bigint | null;
    setPerformedAt(performedAt: bigint | null): this;
    getFailureStatus(): TransferFailureStatus | null;
    setFailureStatus(failureStatus: TransferFailureStatus | null): this;
    getOutCommission(): Money | null;
    setOutCommission(outCommission: Money | null): this;
    getAdditionalInformation(): TransferAdditionalData | null;
    setAdditionalInformation(additionalInformation: TransferAdditionalData | null): this;

    getData(): TransferOutputProperties;
}

export interface TransferPasswordProperties {
    password: string;
}

declare class TransferPassword extends Entity {
    getPassword(): string;
    setPassword(password: string): this;

    getData(): TransferPasswordProperties;
}

export interface TransferPassword34Properties {
    status: string | null;
    value: string;
}

declare class TransferPassword34 extends Entity {
    getStatus(): string | null;
    setStatus(status: string | null): this;
    getValue(): string;
    setValue(value: string): this;

    getData(): TransferPassword34Properties;
}

export interface TransferPurposeProperties {
    details: string | null;
    reference: string | null;
    vo_code: string | null;
    ocr_code: string | null;
    details_options: DetailsOptions | null;
    code: string | null;
}

declare class TransferPurpose extends Entity {
    getDetails(): string | null;
    setDetails(details: string | null): this;
    getReference(): string | null;
    setReference(reference: string | null): this;
    getVoCode(): string | null;
    setVoCode(voCode: string | null): this;
    getOcrCode(): string | null;
    setOcrCode(ocrCode: string | null): this;
    getDetailsOptions(): DetailsOptions | null;
    setDetailsOptions(detailsOptions: DetailsOptions | null): this;
    getCode(): string | null;
    setCode(code: string | null): this;

    getData(): TransferPurposeProperties;
}

export interface TransferRegistrationParametersProperties {
    convert_currency: ConvertCurrency[] | null;
}

declare class TransferRegistrationParameters extends Entity {
    getConvertCurrency(): ConvertCurrency[] | null;
    setConvertCurrency(convertCurrency: ConvertCurrency[] | null): this;

    getData(): TransferRegistrationParametersProperties;
}

export interface TransfersBatchProperties {
    revoked_transfers: string[] | null;
    reserved_transfers: string[] | null;
    convert_currency: ConvertCurrency[] | null;
}

declare class TransfersBatch extends Entity {
    getRevokedTransfers(): string[] | null;
    setRevokedTransfers(revokedTransfers: string[] | null): this;
    getReservedTransfers(): string[] | null;
    setReservedTransfers(reservedTransfers: string[] | null): this;
    getConvertCurrency(): ConvertCurrency[] | null;
    setConvertCurrency(convertCurrency: ConvertCurrency[] | null): this;

    getData(): TransfersBatchProperties;
}

export interface TransfersBatchResultProperties {
    revoked_transfers: TransferOutput[] | null;
    reserved_transfers: TransferOutput[] | null;
}

declare class TransfersBatchResult extends Entity {
    getRevokedTransfers(): TransferOutput[] | null;
    setRevokedTransfers(revokedTransfers: TransferOutput[] | null): this;
    getReservedTransfers(): TransferOutput[] | null;
    setReservedTransfers(reservedTransfers: TransferOutput[] | null): this;

    getData(): TransfersBatchResultProperties;
}

export interface TransfersFilterProperties {
    created_date_from: bigint | null;
    created_date_to: bigint | null;
    credit_account_number: string | null;
    debit_account_number: string | null;
    statuses: string | null;
}

declare class TransfersFilter extends Entity {
    getCreatedDateFrom(): bigint | null;
    setCreatedDateFrom(createdDateFrom: bigint | null): this;
    getCreatedDateTo(): bigint | null;
    setCreatedDateTo(createdDateTo: bigint | null): this;
    getCreditAccountNumber(): string | null;
    setCreditAccountNumber(creditAccountNumber: string | null): this;
    getDebitAccountNumber(): string | null;
    setDebitAccountNumber(debitAccountNumber: string | null): this;
    getStatuses(): string | null;
    setStatuses(statuses: string | null): this;

    getData(): TransfersFilterProperties;
}

export interface WebmoneyAccountProperties {
    purse: string;
}

declare class WebmoneyAccount extends Entity {
    getPurse(): string;
    setPurse(purse: string): this;

    getData(): WebmoneyAccountProperties;
}


interface ClientConfigurationOptions {
    urlParameters?: {
        [key: string]: string,
    },
    [key: string]: any,
}

interface ClientConfiguration {
    baseURL: string,
    middleware?: object[],
    options?: ClientConfigurationOptions
}

export function createTransferClient(configuration: ClientConfiguration): TransferClient;

export interface TransferClient {
    signTransfer(id: string, transferRegistrationParameters: TransferRegistrationParameters): Promise<TransferOutput>
    reserveTransfer(id: string, transferRegistrationParameters: TransferRegistrationParameters): Promise<TransferOutput>
    provideTransferPassword(id: string, transferPassword: TransferPassword): Promise<TransferOutput>
    freezeTransfer(id: string): Promise<TransferOutput>
    completeTransfer(id: string): Promise<TransferOutput>
    registerTransfer(id: string, transferRegistrationParameters: TransferRegistrationParameters): Promise<TransferOutput>
    getTransfer(id: string): Promise<TransferOutput>
    deleteTransfer(id: string): Promise<TransferOutput>
    reserveTransfers(transfersBatch: TransfersBatch): Promise<TransfersBatchResult>
    getTransfers(transfersFilter: TransfersFilter): Promise<FilteredTransfersResult>
    createTransfer(transferInput: TransferInput): Promise<TransferOutput>
}
