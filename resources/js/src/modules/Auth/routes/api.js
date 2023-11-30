export default {
    get() {
        return "/api/auth-profile";
    },

    updateInformation() {
        return "/api/auth-profile";
    },

    updatePassword(user = null) {
        return "/user/password";
    },
};
