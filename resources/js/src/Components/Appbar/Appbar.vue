<script setup>
import { useDisplay } from "vuetify";
import { computed, ref } from "vue";
import { useSidebarStore } from "@components/Sidebar/store/sidebar.js";

const { mdAndUp } = useDisplay();
const sidebar = useSidebarStore();

const sideBarToggle = () => {
    sidebar.$patch((state) => {
        state.sideBarData.model = !state.sideBarData.model;
    });

    sidebar.toggle({ model: sidebar.sideBarData.model });
};

const showMenu = computed(() => {
    return this.$route.name === "dashboard";
});

const appbar = ref({
    model: true,
});
</script>

<template>
    <v-app-bar
        v-if="appbar.model"
        :elevation="2"
        :flat="true"
        :height="mdAndUp ? 83 : 64"
        :model-value="appbar.model"
        :scroll-behavior="'hide'"
        app
        scroll-threshold="30"
    >
        <v-app-bar-nav-icon
            color="muted"
            @click="sideBarToggle()"
        ></v-app-bar-nav-icon>

        <v-spacer></v-spacer>

        <user-is-logged-in>
            <v-menu
                v-if="$route.name === 'dashboard'"
                class="d-flex justify-end ml-10"
                min-width="200px"
                transition="slide-y-transition"
            >
                <template v-slot:activator="{ props }">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on: tooltip }">
                            <div
                                role="button"
                                v-bind="{ ...tooltip, ...props }"
                            >
                                <div
                                    class="d-flex justify-space-between align-center ml-10"
                                >
                                    <v-avatar color="brown" size="default">
                                        <span class="text-h5">Lou</span>
                                    </v-avatar>
                                    <div class="d-none d-md-block ml-5">
                                        <p
                                            class="body-1 mb-0 text--truncate"
                                            v-text="'test'"
                                        ></p>
                                        <div
                                            class="muted--text overline"
                                            v-text="'superadmin'"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <span v-text="'test'"></span>
                    </v-tooltip>
                </template>

                <v-list>
                    <v-list-item :to="{ name: 'auth-profile' }" exact>
                        <v-list-item-action>
                            <v-icon class="text--muted" small
                                >mdi-account-outline
                            </v-icon>
                        </v-list-item-action>
                        <v-list-item>
                            <v-list-item-title
                                v-text="'My Profile'"
                            ></v-list-item-title>
                        </v-list-item>
                    </v-list-item>

                    <v-divider></v-divider>

                    <v-list-item :to="{ name: 'logout' }" exact>
                        <v-list-item-action>
                            <v-icon class="text--muted" small>mdi-power</v-icon>
                        </v-list-item-action>
                        <v-list-item>
                            <v-list-item-title
                                v-text="'Logout'"
                            ></v-list-item-title>
                        </v-list-item>
                    </v-list-item>
                </v-list>
            </v-menu>
        </user-is-logged-in>

        <slot></slot>
    </v-app-bar>
</template>
