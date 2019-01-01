import { createClient } from '@paysera/http-client-common';
import PublicTransfersClient from './PublicTransfersClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {PublicTransfersClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createPublicTransfersClient = ({
    baseURL = 'https://accounts.paysera.com/some/rest/v1/',
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

    return new PublicTransfersClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
