import $app from "@/config/app";
import { defineStore } from "pinia";

export const useAppStore = defineStore("app", {
    state: () => {
        return {
            app: {
                dark: localStorage.getItem("theme:dark") === "true" || false,
                title: $app.title,
                tagline: $app.tagline,
                year: $app.year,
                author: $app.author,
                locale: $app.locale,
            },
        };
    },
    getters: {
        app: (state) => state.app,
        title: (state) => state.app["title"],
        tagline: (state) => state.app["tagline"],
        year: (state) => state.app["year"],
        author: (state) => state.app["author"],
        locale: (state) => state.app["locale"],
    },
    actions: {
        set(payload) {
            this.app = window._.merge({}, this.app, payload);
        },
        locale(locale) {
            this.app.locale = locale;
            localStorage.setItem("app:locale", locale);
            // i18n.locale = locale
            // localStorage.setItem("app:rtl", is_rtl(locale));
        },
    },
});
