import { defineStore } from "pinia";

export const useSettingsStore = defineStore("settings", {
    state: () => {
        return {
            settings: {
                fields: {
                    isDense: false,
                },
            },
        };
    },
    getters: {
        getSettings: (state) => state.settings,
        getFields: (state) => state.settings.fields,
        fieldIsDense: (state) => state.settings.fields.isDense,
    },
    actions: {
        set(payload) {
            this.settings = window._.merge([], this.settings, payload);
        },
    },
});
