import { createClient } from '@paysera/http-client-common';
import UserInfoClient from './UserInfoClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 *
 * @returns {UserInfoClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createUserInfoClient = ({
    baseURL = 'https://example.com/user/rest/v1/',
    middleware = null,
}) => new UserInfoClient(createClient({
    baseURL,
    middleware,
}));
