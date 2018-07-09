import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import Category from '../entity/Category';
import CategoryFilter from '../entity/CategoryFilter';
import { Filter } from '@paysera/http-client-common';

class CategoryClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Enable category
     * PUT /categories/{id}/enable
     *
     * @param {string} id
     * @return {Promise.<Category>}
     */
    enableCategory(id) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}/enable`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }

    /**
     * Disable category
     * PUT /categories/{id}/disable
     *
     * @param {string} id
     * @return {Promise.<Category>}
     */
    disableCategory(id) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}/disable`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }

    /**
     * Update category
     * PUT /categories/{id}
     *
     * @param {string} id
     * @return {Promise.<Category>}
     */
    updateCategory(id) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }
    /**
     * Delete category
     * DELETE /categories/{id}
     *
     * @param {string} id
     * @return {Promise.<null>}
     */
    deleteCategory(id) {
        const request = createRequest(
            'DELETE',
            `categories/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

    /**
     * Standard SQL-style Result filtering
     * GET /categories
     *
     * @param {CategoryFilter} categoryFilter
     * @return {Promise.<null>}
     */
    getCategories(categoryFilter) {
        const request = createRequest(
            'GET',
            `categories`,
            categoryFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }
    /**
     * Create category
     * POST /categories
     *
     * @param {Category} category
     * @return {Promise.<Category>}
     */
    createCategory(category) {
        const request = createRequest(
            'POST',
            `categories`,
            category,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }

    /**
     * Standard SQL-style Result filtering
     * GET /keywords
     *
     * @param {Filter} filter
     * @return {Promise.<null>}
     */
    getKeywords(filter) {
        const request = createRequest(
            'GET',
            `keywords`,
            filter,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

}

export default CategoryClient;
