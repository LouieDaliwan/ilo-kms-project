import { defineStore } from "pinia";
import _ from "lodash";

export const initials = {
    // Toggle
    show: false,
    loading: false,

    // Settings
    persistent: false,
    width: 420,
    maxWidth: 800,
    color: null,
    light: null,
    dark: null,

    // Illustration
    illustration: null,
    // illustration: () => import('@/components/Icons/ErrorIcon.vue'),
    illustrationWidth: 200,
    illustrationHeight: 200,

    // Text
    title: false,
    text: false,

    // Alignment
    alignment: false, // e.g. 'center'

    // Buttons
    buttons: {
        action: {
            show: true,
            color: "primary",
            text: "Okay",
            callback: () => {
                this.close();
            },
        },

        cancel: {
            show: true,
            color: "dark",
            text: "Cancel",
            callback: () => {
                this.close();
            },
        },
    },
};

export const useDialogStore = defineStore("dialog", {
    state: () => {
        return {
            dialog: _.clone(initials),
        };
    },
    getters: {
        getDialog: (state) => state.dialog,
    },
    actions: {
        close() {
            this.dialog.show = false;
            this.dialog.loading = false;
        },
        reset() {
            this.dialog = initials;
        },

        prompt(payload) {
            console.log(payload);
            this.dialog = _.merge({}, this.dialog, payload, {
                loading: false,
            });
        },
        open(payload) {
            this.reset();
            this.prompt(Object.assign(payload, { show: true }));
        },

        show(payload) {
            this.reset();
            console.log("show");
            this.prompt(Object.assign(payload, { show: true }));
        },
        hide() {
            this.close();
        },
        loading(loading) {
            this.dialog.loading = loading;
        },
        error(payload) {
            this.reset();
            this.prompt_error(payload);
        },
        prompt_error(payload) {
            this.dialog = _.merge(
                {},
                this.dialog,
                {
                    illustration: () =>
                        import("@/components/Icons/ErrorIcon.vue"),
                    loading: false,
                    show: true,
                    buttons: {
                        cancel: { show: false },
                        action: {
                            text: "Okay",
                            color: null,
                            callback: () => {
                                this.error({ show: false });
                            },
                        },
                    },
                },
                payload,
            );
        },
    },
});
