import { defineStore } from "pinia";
import { useSuccessBoxStore } from "./successbox";
import { useErrorBoxStore } from "./errorbox";

const successBoxStore = useSuccessBoxStore();
const errorBoxStore = useErrorBoxStore();

export const useAlertBoxStore = defineStore("alertBox", {
    state: () => ({
        alertbox: {
            border: "left",
            color: null,
            dense: true,
            dismissible: true,
            icon: null,
            list: [],
            outlined: true,
            prominent: true,
            show: false,
            text: null,
            type: "success",
        },
    }),
    getters: {},
    actions: {
        set(payload) {
            this.alertbox = Object.assign({}, this.alertbox, payload);
        },
        show() {
            this.alertbox = Object.assign({}, this.alertbox, payload, {
                show: true,
            });
        },
        hide() {
            this.successbox.hide();
            this.errorbox.hide();
            this.alertbox = Object.assign({}, this.alertbox, payload, {
                show: false,
            });
        },
    },
});
