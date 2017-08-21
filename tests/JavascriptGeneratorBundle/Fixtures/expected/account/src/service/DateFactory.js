class DateFactory {

    /**
     * @param {int} date
     * @returns {Date}
     */
    static create(date) {
        if (date.toString().length === 10) {
            date *= 1000;
        }

        return new Date(date);
    }
}

export default DateFactory;
