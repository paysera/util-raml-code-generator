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

export function createCustomClient(configuration: ClientConfiguration): CustomClient;

export interface CustomClient {
    customNameForMethod(): Promise<null>
}
