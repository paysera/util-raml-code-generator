class DateFactory {
    /**
     * @param {int} date
     * @returns {Date}
     */
    static create(date) {
        let dateValue = date;
        if (dateValue.toString().length === 10) {
            dateValue *= 1000;
        }

        return new Date(dateValue);
    }
}

export default DateFactory;
