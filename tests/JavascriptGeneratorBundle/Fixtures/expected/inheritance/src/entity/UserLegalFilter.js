import UserFilter from './UserFilter';

class UserLegalFilter extends UserFilter {
    /**
     * @return {string}|null
     */
    getCompanyName() {
        return this.get('company_name');
    }

    /**
     * @param {string} companyName
     */
    setCompanyName(companyName) {
        this.set('company_name', companyName);
    }
}

export default UserLegalFilter;
