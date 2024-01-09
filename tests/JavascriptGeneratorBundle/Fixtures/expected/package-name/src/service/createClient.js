import { createClient } from '@paysera/http-client-common';
import PackageNameClient from './PackageNameClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {PackageNameClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createPackageNameClient = ({
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

    return new PackageNameClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
