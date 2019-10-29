import { createClient } from '@paysera/http-client-common';
import IssuedPaymentCardClient from './IssuedPaymentCardClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {IssuedPaymentCardClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createIssuedPaymentCardClient = ({
    baseURL = 'https://accounts.paysera.com/public/issued-payment-card/v1/',
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

    return new IssuedPaymentCardClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};
