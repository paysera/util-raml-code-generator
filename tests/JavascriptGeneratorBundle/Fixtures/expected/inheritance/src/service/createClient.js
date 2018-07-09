import { createClient } from '@paysera/http-client-common';
import InheritanceClient from './InheritanceClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {InheritanceClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createInheritanceClient = ({
    baseURL = 'https://example.com/user/rest/v1/',
    middleware = null,
}) => new InheritanceClient(createClient({
    baseURL,
    middleware,
}));
