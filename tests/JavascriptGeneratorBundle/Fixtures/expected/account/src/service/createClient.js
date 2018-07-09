import { createClient } from '@paysera/http-client-common';
import AccountClient from './AccountClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {AccountClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createAccountClient = ({
    baseURL = 'https://my-api.example.com/rest/v1/',
    middleware = null,
}) => new AccountClient(createClient({
    baseURL,
    middleware,
}));
