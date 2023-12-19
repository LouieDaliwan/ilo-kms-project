import $app from "@/config/app";
import i18n from "@/plugins/i18n";

export const state = () => ({
    app: {
        dark: localStorage.getItem("theme:dark") === "true" || false,
        title: $app.title,
        tagline: $app.tagline,
        year: $app.year,
        author: $app.author,
        locale: $app.locale,
    },
});

export const getters = {
    app: (state) => state.app,
    title: (state) => state.app["title"],
    tagline: (state) => state.app["tagline"],
    year: (state) => state.app["year"],
    author: (state) => state.app["author"],
    locale: (state) => state.app["locale"],
};

export const mutations = {
    SET_APP(state, payload) {
        state.app = window._.merge({}, state.app, payload);
    },

    SET_LOCALE(state, locale) {
        state.app.locale = locale;
        i18n.locale = locale;
        localStorage.setItem("app:rtl", is_rtl(locale));
        localStorage.setItem("app:locale", locale);
    },
};

export const actions = {
    set: ({ commit }, payload) => {
        commit("SET_APP", payload);
    },

    locale: function ({ commit }, locale) {
        commit("SET_LOCALE", locale);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
