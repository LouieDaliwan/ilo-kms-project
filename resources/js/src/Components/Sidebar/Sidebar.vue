<template>
    <v-navigation-drawer
        v-model="sidebarModel"
        :clipped="true"
        app
        class="dt-sidebar secondary workspace-x v-navigation-drawer v-navigation-drawer--fixed v-navigation-drawer--floating v-navigation-drawer--custom-mini-variant v-navigation-drawer--open theme--light sidebar"
        fixed
    >
        <brand></brand>

        <menus></menus>

        <!-- Sidebar Footer -->
        <template v-slot:append>
            <div class="px-4 py-2 d-flex justify-space-between align-center">
                <div class="white--text">
                    <small>
                        <div>Powered by</div>
                        <div>Louie Daliwan &copy; 2023</div>
                    </small>
                </div>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script>
import app from "@/config/app";

export default {
    name: "Sidebar",
    data() {
        return {
            sidebarModel: "",
        };
    },

    computed: {
        app() {
            return app;
        },
    },
};
</script>
