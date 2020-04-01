import { Result } from '@paysera/http-client-common';
import { Entity } from '@paysera/http-client-common';

interface QuestionnaireUsersResultProperties {
}

export interface QuestionnaireUsersResult extends Result {

    getData(): QuestionnaireUsersResultProperties;
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

export function createQuestionnaireClient(configuration: ClientConfiguration): QuestionnaireClient;

export interface QuestionnaireClient {
    getQuestionnaireUsersIds(): Promise<QuestionnaireUsersResult>
}
