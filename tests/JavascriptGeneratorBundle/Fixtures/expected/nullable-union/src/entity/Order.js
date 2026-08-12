import OrderLine from './OrderLine';
import { Entity } from '@paysera/http-client-common';

class Order extends Entity {
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
    getNote() {
        return this.get('note');
    }

    /**
     * @param {string} note
     */
    setNote(note) {
        this.set('note', note);
    }

    /**
     * @return {string|null}
     */
    getDiscount() {
        return this.get('discount');
    }

    /**
     * @param {string} discount
     */
    setDiscount(discount) {
        this.set('discount', discount);
    }

    /**
     * @return {OrderLine|null}
     */
    getLine() {
        if (this.get('line') == null) {
            return null;
        }
        return new OrderLine(this.get('line'));
    }

    /**
     * @param {OrderLine} line
     */
    setLine(line) {
        this.set('line', line.getData());
    }

    /**
     * @return {Array.<string>|null}
     */
    getTags() {
        return this.get('tags');
    }

    /**
     * @param {Array.<string>} tags
     */
    setTags(tags) {
        this.set('tags', tags);
    }

    /**
     * @return {Array.<OrderLine>}
     */
    getLines() {
        let data = this.get('lines');
        if (data === null) {
            return [];
        }

        let collection = [];
        for (let value of data) {
            collection.push(new OrderLine(value));
        }

        return collection;
    }

    /**
     * @param {Array.<OrderLine>} lines
     */
    setLines(lines) {
        let data = [];
        for (let entity of lines) {
            data.push(entity.getData());
        }
        this.set('lines', data);
    }
}

export default Order;
