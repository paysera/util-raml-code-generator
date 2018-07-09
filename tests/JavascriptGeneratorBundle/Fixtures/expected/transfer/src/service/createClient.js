import { createClient } from '@paysera/http-client-common';
import TransferClient from './TransferClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {TransferClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createTransferClient = ({
    baseURL = 'https://my-api.example.com/rest/v1/',
    middleware = null,
}) => new TransferClient(createClient({
    baseURL,
    middleware,
}));
