import { createClient } from '@paysera/http-client-common';
import QuestionnaireClient from './QuestionnaireClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {QuestionnaireClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createQuestionnaireClient = ({
    baseURL = 'https://my-api.example.com/rest/v1/',
    middleware = null,
}) => new QuestionnaireClient(createClient({
    baseURL,
    middleware,
}));
