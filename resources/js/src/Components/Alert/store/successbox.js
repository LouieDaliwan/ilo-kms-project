import { defineStore } from "pinia";

export const useSuccessBoxStore = defineStore("successBox", {
    state: () => {
        return {
            successbox: {
                border: "top",
                color: null,
                dense: true,
                dismissible: true,
                icon: null,
                outlined: true,
                prominent: true,
                show: false,
                text: "Item successfully updated.",
                type: "success",
                buttons: {
                    show: {
                        to: null,
                        text: "Show Details",
                        icon: "mdi-pencil",
                    },
                    create: {
                        to: null,
                        text: "Create New Item",
                        icon: "mdi-file-plus-outline",
                    },
                },
            },
        };
    },
    getters: {
        successBoxStore: (state) => state.successbox,
        showSuccessBox: (state) => state.successbox.show,
    },
    actions: {
        set(payload) {
            this.reset();
            this.successbox = Object.assign({}, this.successbox, payload);
        },
        show(payload) {
            this.reset();
            this.successbox = Object.assign({}, this.successbox, payload, {
                show: true,
            });
        },
        hide(payload = {}) {
            this.reset();
            this.successbox = Object.assign({}, this.successbox, payload, {
                show: false,
            });
        },
        reset() {
            this.successbox = window._.clone(this.successbox);
        },
    },
});
