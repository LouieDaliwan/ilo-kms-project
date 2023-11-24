export default {
    get() {
        return "/auth/profile";
    },
    updatePassword(user = null) {
        return "/user/password";
    },

};
