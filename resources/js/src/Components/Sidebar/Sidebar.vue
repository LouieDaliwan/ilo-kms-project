<script>
import app from "@/config/app";
import { useDisplay } from "vuetify";
import { mapActions, mapState } from "pinia";
import { useSidebarStore } from "./store/sidebar.js";

export default {
    name: "Sidebar",
    data() {
        return {
            drawer: true,
        };
    },

    setup() {
        const { mdAndUp } = useDisplay();
        return { mdAndUp };
    },

    computed: {
        app() {
            return app;
        },

        ...mapState(
            useSidebarStore,
            ["sidebar"],
            // dark: "theme/dark",
            // lang: "app/locale",
        ),

        sidebarModel: {
            set(value) {
                this.toggle({ model: value });
            },
            get() {
                return this.sidebar.model;
            },
        },
    },

    methods: {
        ...mapActions(useSidebarStore, [
            "toggle",
            "clip",
            "hide",
            "update",
            "show",
        ]),
    },
};
</script>

<template>
    <v-navigation-drawer
        v-model="sidebarModel"
        :expand-on-hover="sidebar.mini"
        :permanent="true"
        app
        class="dt-sidebar secondary workspace-x v-navigation-drawer v-navigation-drawer--fixed v-navigation-drawer--floating v-navigation-drawer--custom-mini-variant v-navigation-drawer--open theme--light sidebar"
        fixed
        location="left"
    >
        <brand class="my-3"></brand>

        <menus></menus>

        <!-- Sidebar Footer -->
        <template v-slot:append>
            <div class="px-4 py-2 d-flex justify-space-between align-center">
                <div class="white--text">
                    <small>
                        <div>Powered by</div>
                        <div>SSA Group &copy; 2023</div>
                    </small>
                </div>
            </div>
        </template>
    </v-navigation-drawer>
</template>
