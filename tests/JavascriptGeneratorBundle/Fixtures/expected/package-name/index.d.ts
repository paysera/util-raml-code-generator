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

export function createPackageNameClient(configuration: ClientConfiguration): PackageNameClient;

export interface PackageNameClient {
}
