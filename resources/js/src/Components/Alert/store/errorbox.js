import { defineStore } from "pinia";

export const useErrorBoxStore = defineStore("errorBox", {
    state: () => {
        return {
            errorbox: {
                border: "top",
                color: null,
                dense: true,
                dismissible: true,
                icon: null,
                errors: [],
                outlined: true,
                prominent: true,
                show: false,
                text: "An error occured.",
                type: "error",
            },
        };
    },
    getters: {
        errorBoxStore: (state) => state.errorbox,
        showErrorBox: (state) => state.errorbox.show,
    },
    actions: {
        set(payload) {
            this.reset();
            this.errorbox = Object.assign({}, this.errorbox, payload);
        },
        show(payload) {
            this.reset();
            this.errorbox = Object.assign({}, this.errorbox, payload, {
                show: true,
            });
        },
        hide(payload = {}) {
            this.reset();
            this.errorbox = Object.assign({}, this.errorbox, payload, {
                show: false,
            });
        },
        reset() {
            this.errorbox = window._.clone(this.errorbox);
        },
    },
});
