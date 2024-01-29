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
            navDrawer: false,

        };
    },

    setup() {
        const { mdAndUp, mdAndDown } = useDisplay();
        return { mdAndUp, mdAndDown };

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

        sideBarToggle(e) {
            const sidebar = useSidebarStore();
            sidebar.$patch((state) => {
                state.sideBarData.model = true;
                // state.sideBarData.model = !state.sideBarData.model;
            });

            sidebar.toggle({ model: sidebar.sideBarData.model });
            // console.log(sidebar.sideBarData.model)

        },
    },
    mounted () {
      if (this.$vuetify.display.mobile) {
        this.drawer = false
      }
      else {
        this.drawer = true
      }
    },

};
</script>

<template>
    <v-navigation-drawer
        :model-value="sidebarModel"
        :expand-on-hover="sidebar.mini"
        :permanent="this.mdAndUp"
        app
        class="dt-sidebar secondary workspace-x v-navigation-drawer v-navigation-drawer--fixed v-navigation-drawer--floating v-navigation-drawer--custom-mini-variant v-navigation-drawer--open theme--light sidebar"
        fixed
        location="left"
        temporary
        style="top: 9rem;"

    >

            <div v-if="mdAndDown" v-click-outside="sideBarToggle"></div>
            <!-- <brand class="my-3"></brand> -->
            <h4 class="ms-4 py-6">Context</h4>
            <menus></menus>

        <!-- Sidebar Footer -->
        <!-- <template v-slot:append >
            <div class="px-4 py-2 d-flex justify-space-between align-center">
                <div class="white--text">
                    <small>
                        <div>Powered by</div>
                        <div>SSA Group &copy; 2023</div>
                    </small>
                </div>
            </div>
        </template> -->

    </v-navigation-drawer>

</template>
