import { createClient } from '@paysera/http-client-common';
import PackageVersionClient from './PackageVersionClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {PackageVersionClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createPackageVersionClient = ({
    baseURL = 'https://library-address/rest/v1/',
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

    return new PackageVersionClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
