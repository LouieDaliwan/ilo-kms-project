import { defineStore } from "pinia";
import { useSuccessBoxStore } from "./successbox";
import { useErrorBoxStore } from "./errorbox";

const successBoxStore = useSuccessBoxStore();
const errorBoxStore = useErrorBoxStore();

export const useAlertBoxStore = defineStore("alertBox", {
    state: () => ({
        alertBox: {
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
    actions: {
        set(payload) {
            this.alertBox = Object.assign({}, this.alertBox, payload);
        },
        show(payload) {
            this.alertBox = Object.assign({}, this.alertBox, payload, {
                show: true,
            });
        },
        hide(payload = {}) {
            successBoxStore.hide();
            errorBoxStore.hide();
            this.alertBox = Object.assign({}, this.alertBox, payload, {
                show: false,
            });
        },
    },
});
