import { defineStore } from "pinia";

export const useMetatagStore = defineStore("metatag", {
    state: () => {
        return {
            metatag: {
                title: "",
                description: "",
            },
        };
    },
    getters: {
        getMetatag: (state) => state.metatag,
        getTitle: (state) => state.metatag.title,
        geDescription: (state) => state.metatag.description,
    },
    actions: {
        title(title) {
            this.metatag.title = title;
        },
        description(description) {
            this.metatag.description = description;
        },
    },
});
