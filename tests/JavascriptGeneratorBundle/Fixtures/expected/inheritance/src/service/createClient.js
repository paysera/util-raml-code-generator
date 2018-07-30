import { createClient } from '@paysera/http-client-common';
import InheritanceClient from './InheritanceClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {InheritanceClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createInheritanceClient = ({
    baseURL = 'https://example.com/user/rest/v1/',
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

    return new InheritanceClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
