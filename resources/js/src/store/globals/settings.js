export const state = () => ({
    settings: {
        fields: {
            isDense: false,
        },
    },
});

export const getters = {
    settings: (state) => state.settings,
    fields: (state) => state.settings.fields,
    fieldIsDense: (state) => state.settings.fields.isDense,
};

export const mutations = {
    SET_SETTINGS(state, payload) {
        state.settings = window._.merge({}, state.settings, payload);
    },
};

export const actions = {
    set: ({ commit }, payload) => {
        commit("SET_SETTINGS", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
