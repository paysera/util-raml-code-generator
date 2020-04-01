import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';

interface CardIssuePriceProperties {
    price: Money;
    country: string;
    client_type: string;
}

export interface CardIssuePrice extends Entity {
    getPrice(): Money;
    setPrice(price: Money): this;
    getCountry(): string;
    setCountry(country: string): this;
    getClientType(): string;
    setClientType(clientType: string): this;

    getData(): CardIssuePriceProperties;
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

export function createIssuedPaymentCardClient(configuration: ClientConfiguration): IssuedPaymentCardClient;

export interface IssuedPaymentCardClient {
    getCardIssuePrice(country: string, clientType: string, cardOwnerId: string): Promise<CardIssuePrice>
}
