import { Filter } from '@paysera/http-client-common';

class UserFilter extends Filter {
    /**
     * @return {Number|null}
     */
    getUserId() {
        return this.get('user_id');
    }

    /**
     * @param {Number} userId
     */
    setUserId(userId) {
        this.set('user_id', userId);
    }

    /**
     * @return {string|null}
     */
    getUserType() {
        return this.get('user_type');
    }

    /**
     * @param {string} userType
     */
    setUserType(userType) {
        this.set('user_type', userType);
    }
}

export default UserFilter;
