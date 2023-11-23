import { acceptHMRUpdate, defineStore } from "pinia";
import VM from "@/mixins/localstorage";

export const useSidebarStore = defineStore("sidebar", {
    state: () => ({
        sideBarData: {
            dark: VM.methods.localstorage("app.dark", "true") === "true",
            clipped: VM.methods.localstorage("sidebar.clipped") === "true",
            floating: VM.methods.localstorage("sidebar.floating") === "true",
            mini: VM.methods.localstorage("sidebar.mini") === "true",
            model: VM.methods.localstorage("sidebar.model") === "true",

            title: "",
            logo: "",
            tagline: "",
        },
    }),
    actions: {
        toggle: (payload) => {
            VM.methods.localstorage({ "sidebar.model": payload.model });
        },

        show: (payload) => {
            VM.methods.localstorage({ "sidebar.model": true });
        },

        hide: (payload) => {
            VM.methods.localstorage({ "sidebar.model": false });
        },
        clip: (payload) => {
            VM.methods.localstorage({ "sidebar.clipped": payload.clipped });
        },

        update: (payload) => {
            VM.methods.localstorage({ "sidebar.dark": payload.dark });
        },
    },
    getters: {
        sidebar: (state) => state.sideBarData,
    },
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useSidebarStore, import.meta.hot));
}
