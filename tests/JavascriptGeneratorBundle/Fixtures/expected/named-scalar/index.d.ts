import { Result } from '@paysera/http-client-common';
import { Entity } from '@paysera/http-client-common';

export interface CurrencyResultProperties {
}

declare class CurrencyResult extends Result {

    getData(): CurrencyResultProperties;
}

export interface PaymentProperties {
    id: string;
    currency: string;
    allowed_currencies: string[] | null;
    account_number: string;
    scan_result: string | null;
    filter_mode: string | null;
    metadata: PaymentMetadata | null;
    search_metadata: SearchResultMetadata | null;
}

declare class Payment extends Entity {
    getId(): string;
    setId(id: string): this;
    getCurrency(): string;
    setCurrency(currency: string): this;
    getAllowedCurrencies(): string[] | null;
    setAllowedCurrencies(allowedCurrencies: string[] | null): this;
    getAccountNumber(): string;
    setAccountNumber(accountNumber: string): this;
    getScanResult(): string | null;
    setScanResult(scanResult: string | null): this;
    getFilterMode(): string | null;
    setFilterMode(filterMode: string | null): this;
    getMetadata(): PaymentMetadata | null;
    setMetadata(metadata: PaymentMetadata | null): this;
    getSearchMetadata(): SearchResultMetadata | null;
    setSearchMetadata(searchMetadata: SearchResultMetadata | null): this;

    getData(): PaymentProperties;
}

export interface PaymentMetadataProperties {
    source: string;
    channel: string | null;
}

declare class PaymentMetadata extends Entity {
    getSource(): string;
    setSource(source: string): this;
    getChannel(): string | null;
    setChannel(channel: string | null): this;

    getData(): PaymentMetadataProperties;
}

export interface SearchResultMetadataProperties {
    source: string;
    matched: bigint | null;
}

declare class SearchResultMetadata extends Entity {
    getSource(): string;
    setSource(source: string): this;
    getMatched(): bigint | null;
    setMatched(matched: bigint | null): this;

    getData(): SearchResultMetadataProperties;
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

export function createNamedScalarClient(configuration: ClientConfiguration): NamedScalarClient;

export interface NamedScalarClient {
    createPayment(payment: Payment): Promise<Payment>
    getCurrencies(): Promise<CurrencyResult>
}
