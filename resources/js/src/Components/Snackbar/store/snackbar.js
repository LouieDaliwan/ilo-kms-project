import { defineStore } from "pinia";

export const useSnackbarStore = defineStore("snackbar", {
    state: () => ({
        snackbar: {
            show: false,

            text: "text",
            icon: false,

            color: "dark",
            timeout: 8000,
            mode: null,

            x: "center",
            y: "top",

            button: {
                show: true,
                icon: false,
                text: "Close",
                callback: () => {
                    this.toggle({ show: false });
                },
            },
        },
    }),
    getters: {
        getSnackbar: (state) => state.snackbar,
        isShowing: (state) => state.snackbar.show,
    },
    actions: {
        toggle(payload) {
            this.snackbar = window._.merge({}, this.snackbar, payload);
        },
        show(payload) {
            this.snackbar = window._.merge({}, this.snackbar, payload, {
                show: true,
            });
        },
        hide() {
            this.toggle({ show: false });
        },
    },
});
