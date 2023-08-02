export default {
    list() {
        return "/api/v1/users";
    },

    store() {
        return "/api/v1/users";
    },

    show(id = null) {
        return `/api/v1/users/${id}`;
    },

    update(id = null) {
        return `/api/v1/users/${id}`;
    },

    delete(id = null) {
        return `/api/v1/users/${id}`;
    },

    restore(id = null) {
        return `/api/v1/users/${id}/restore`;
    },

    trashed() {
        return "api/v1/users/trashed";
    },

    destroy(id = null) {
        return `/api/v1/users/${id}/destroy`;
    },
};
