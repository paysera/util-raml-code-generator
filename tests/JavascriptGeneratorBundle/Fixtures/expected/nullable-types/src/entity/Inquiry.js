import Reviewer from './Reviewer';
import { Entity } from '@paysera/http-client-common';

class Inquiry extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}
     */
    getId() {
        return this.get('id');
    }

    /**
     * @param {string} id
     */
    setId(id) {
        this.set('id', id);
    }

    /**
     * @return {string}
     */
    getQuestion() {
        return this.get('question');
    }

    /**
     * @param {string} question
     */
    setQuestion(question) {
        this.set('question', question);
    }

    /**
     * @return {string|null}
     */
    getComment() {
        return this.get('comment');
    }

    /**
     * @param {string} comment
     */
    setComment(comment) {
        this.set('comment', comment);
    }

    /**
     * @return {boolean|null}
     */
    isFulfilled() {
        return this.get('fulfilled');
    }

    /**
     * @param {boolean} fulfilled
     */
    setFulfilled(fulfilled) {
        this.set('fulfilled', fulfilled);
    }

    /**
     * @return {DateTime|null}
     */
    getReviewedAt() {
        if (this.get('reviewed_at') == null) {
            return null;
        }
        return DateTime.fromFormat(this.get('reviewed_at'), "yyyy-MM-dd'T'HH:mm:ssZZ");
    }

    /**
     * @param {DateTime} reviewedAt
     */
    setReviewedAt(reviewedAt) {
        this.set('reviewed_at', reviewedAt.toFormat("yyyy-MM-dd'T'HH:mm:ssZZ"));
    }

    /**
     * @return {Reviewer|null}
     */
    getReviewer() {
        if (this.get('reviewer') == null) {
            return null;
        }
        return new Reviewer(this.get('reviewer'));
    }

    /**
     * @param {Reviewer} reviewer
     */
    setReviewer(reviewer) {
        this.set('reviewer', reviewer.getData());
    }
}

export default Inquiry;
