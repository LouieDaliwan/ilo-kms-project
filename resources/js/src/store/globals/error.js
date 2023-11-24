export const state = () => ({
    error: {
        code: null,
        message: null,
        stacktrace: [],
    },
});

export const getters = {
    error: (state) => state.error,
    code: (state) => state.error["code"],
    message: (state) => state.error["message"],
    stacktrace: (state) => state.error["stacktrace"],
};

export const mutations = {
    SET_ERROR(state, payload) {
        state.error = window._.merge({}, state.error, payload);
    },
};

export const actions = {
    set: ({ commit }, payload) => {
        commit("SET_ERROR", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
