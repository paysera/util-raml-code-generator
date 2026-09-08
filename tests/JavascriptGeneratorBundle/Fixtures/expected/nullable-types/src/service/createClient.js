import { createClient } from '@paysera/http-client-common';
import NullableTypesClient from './NullableTypesClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {NullableTypesClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createNullableTypesClient = ({
    baseURL = 'https://example.com/nullable-types/rest/v1/',
    middleware = null,
    options = {}
}) => {
    const defaultUrlParameters = {};
    
    if (Object.prototype.hasOwnProperty.call(options, 'urlParameters')) {
        const { urlParameters } = options;
        for (let [key, value] of Object.entries(defaultUrlParameters)) {
            if (!Object.prototype.hasOwnProperty.call(urlParameters, key)) {
                urlParameters[key] = value;
            }
        }
        options.urlParameters = urlParameters;
    }

    return new NullableTypesClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
