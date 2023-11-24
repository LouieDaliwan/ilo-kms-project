export const state = () => ({
    theme: {
        dark: localStorage.getItem("theme:dark") == "true" || false,
    },
});

export const getters = {
    isDark: (state) => state.theme.dark,
    dark: (state) => state.theme.dark,
};

export const mutations = {
    TOGGLE_THEME(state, payload) {
        state.theme.dark = payload.dark;
        state.theme.isDark = payload.dark;
    },
};

export const actions = {
    toggle: ({ commit }, payload) => {
        localStorage.setItem("theme:dark", payload.dark || false);
        payload.vm.theme.dark = payload.dark || false;
        commit("TOGGLE_THEME", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
