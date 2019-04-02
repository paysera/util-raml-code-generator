import { Filter } from '@paysera/http-client-common';

class CategoryFilter extends Filter {
    /**
     * @return {string|null}
     */
    getParentId() {
        return this.get('parent_id');
    }

    /**
     * @param {string} parentId
     */
    setParentId(parentId) {
        this.set('parent_id', parentId);
    }
}

export default CategoryFilter;
