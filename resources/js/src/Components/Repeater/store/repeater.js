import { defineStore } from "pinia";

export const useRepeaterStore = defineStore("repeater", {
    state: () => {
        return {
            repeater: {
                template: { key: "", value: "" },
                items: [],
            },
        };
    },
    getters: {
        getItems: (state) => state.repeater.items,
        getTemplate: (state) => state.repeater.template,
    },
    actions: {
        add() {
            (this.repeater.items || []).push(this.repeater.template);
        },
        set(payload) {
            this.repeater.items = window._.merge([], payload);
        },
        remove(payload) {
            this.repeater.items.splice(payload, 1);
        },
    },
});
