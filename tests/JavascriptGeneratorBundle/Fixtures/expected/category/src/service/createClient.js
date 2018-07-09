import { createClient } from '@paysera/http-client-common';
import CategoryClient from './CategoryClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {CategoryClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createCategoryClient = ({
    baseURL = 'https://my-api.example.com/rest/v1/',
    middleware = null,
}) => new CategoryClient(createClient({
    baseURL,
    middleware,
}));
