import { Money } from '@paysera/money';
import { Entity } from '@paysera/http-client-common';


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

export function createPublicTransfersClient(configuration: ClientConfiguration): PublicTransfersClient;

export interface PublicTransfersClient {
    getTransferRequiredSupplement(transferId: string): Promise<Money>
    updateTransferSms(transferId: string): Promise<null>
}
