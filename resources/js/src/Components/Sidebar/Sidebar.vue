<template>
    <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        app
        class="dt-sidebar secondary workspace-x v-navigation-drawer v-navigation-drawer--fixed v-navigation-drawer--floating v-navigation-drawer--custom-mini-variant v-navigation-drawer--open theme--light sidebar"
        permanent
        @click="toggleRail(false)"
    >
        <brand :railActive="rail" class="my-3" @toggleRail="toggleRail"></brand>

        <menus></menus>

        <!-- Sidebar Footer -->
        <template v-if="!rail" v-slot:append>
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

<script>
import app from "@/config/app";

export default {
    name: "Sidebar",
    data() {
        return {
            drawer: true,
            rail: false,
        };
    },

    mounted() {
        this.checkRail();
    },

    computed: {
        app() {
            return app;
        },
    },

    methods: {
        toggleRail(val) {
            localStorage.setItem("rail", val);
            this.rail = val;
        },

        checkRail: function () {
            this.rail =
                localStorage.getItem("rail") !== null
                    ? localStorage.getItem("rail") === "true"
                    : localStorage.setItem("rail", false);
        },
    },
};
</script>
