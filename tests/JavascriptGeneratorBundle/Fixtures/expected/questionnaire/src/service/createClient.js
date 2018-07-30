import { createClient } from '@paysera/http-client-common';
import QuestionnaireClient from './QuestionnaireClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {QuestionnaireClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createQuestionnaireClient = ({
    baseURL = 'https://my-api.example.com/rest/v1/{locale}/',
    middleware = null,
    options = {}
}) => {
    const defaultUrlParameters = {
        'locale': 'en',
    };
    
    if (Object.prototype.hasOwnProperty.call(options, 'urlParameters')) {
        const { urlParameters } = options;
        for (let [key, value] of Object.entries(defaultUrlParameters)) {
            if (!Object.prototype.hasOwnProperty.call(urlParameters, key)) {
                urlParameters[key] = value;
            }
        }
        options.urlParameters = urlParameters;
    }

    return new QuestionnaireClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
