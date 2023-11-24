import { defineStore } from "pinia";

export const useSettingsStore = defineStore("settings", {
    state: () => ({
        settings: {
            fields: {
                isDense: false,
            },
        },
    }),
    actions: {
        set(payload) {
            this.settings = window._.merge({}, this.settings, payload);
        },
    },
    getters: {
        settings: (state) => state.settings,
        fields: (state) => state.settings.fields,
        fieldIsDense: (state) => state.settings.fields.isDense,
    },
});
