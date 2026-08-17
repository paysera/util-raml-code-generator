import { Entity } from '@paysera/http-client-common';

class SearchResultMetadata extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getSource() {
        return this.get('source');
    }

    /**
     * @param {string} source
     */
    setSource(source) {
        this.set('source', source);
    }

    /**
     * @return {Number|null}
     */
    getMatched() {
        return this.get('matched');
    }

    /**
     * @param {Number} matched
     */
    setMatched(matched) {
        this.set('matched', matched);
    }
}

export default SearchResultMetadata;
