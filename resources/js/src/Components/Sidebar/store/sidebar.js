import VM from "@/mixins/localstorage";

export const state = () => ({
    sidebar: {
        model: VM.methods.localstorage("sidebar.model") === "true",
        dark: VM.methods.localstorage("app.dark", "true") === "true",

        clipped: VM.methods.localstorage("sidebar.clipped") === "true",
        floating: VM.methods.localstorage("sidebar.floating") === "true",
        mini: VM.methods.localstorage("sidebar.mini") === "true",

        title: "",
        logo: "",
        tagline: "",
        // menus: menus.children,
    },
});

export const getters = {
    sidebar: (state) => state.sidebar,
};

export const mutations = {
    TOGGLE(state, payload) {
        state.sidebar.model = payload.model;
    },

    CLIP(state, payload) {
        state.sidebar.clipped = payload.clipped;
    },

    SHOW(state) {
        state.sidebar.model = true;
    },

    HIDE(state) {
        state.sidebar.model = false;
    },

    UPDATE(state, payload) {
        state.sidebar = Object.assign({}, state.sidebar, payload);
    },
};

export const actions = {
    toggle: ({ commit }, payload) => {
        VM.methods.localstorage({ "sidebar.model": payload.model });
        commit("TOGGLE", payload);
    },

    show: ({ commit }) => {
        VM.methods.localstorage({ "sidebar.model": true });
        commit("SHOW");
    },

    hide: ({ commit }) => {
        VM.methods.localstorage({ "sidebar.model": false });
        commit("HIDE");
    },

    clip: ({ commit }, payload) => {
        VM.methods.localstorage({ "sidebar.clipped": payload.clipped });
        commit("CLIP", payload);
    },

    update: ({ commit }, payload) => {
        VM.methods.localstorage({ "sidebar.dark": payload.dark });
        commit("UPDATE", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
