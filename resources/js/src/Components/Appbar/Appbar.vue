<script setup>
import $api from "../../modules/Auth/routes/api";
import { useDisplay } from "vuetify";
import { computed, onMounted, ref } from "vue";
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

const userData = ref(null);
const userInitials = ref(null);

onMounted(async () => {
    await axios.get($api.get()).then((response) => {
        /** Please include this into auth.js -- Louie Daliwan**/
        userData.value = response.data.data.displayname;
        //   console.log(response.data.data)

        // Initials

        //splits words to array
        let nameArray = response.data.data.displayname.split(" ");

        userInitials.value = "";

        //if it's a single word, return 1st and 2nd character
        if (nameArray.length === 1) {
            return nameArray[0].charAt(0) + "" + nameArray[0].charAt(1);
        } else {
            userInitials.value = nameArray[0].charAt(0);
        }
        //else it's more than one, concat the initials in a loop
        //we've gotten the first word, get the initial of the last word

        //first word
        for (let i = nameArray.length - 1; i < nameArray.length; i++) {
            userInitials.value += nameArray[i].charAt(0);
        }
        //return capitalized initials
        return userInitials.value.toUpperCase();
    });
});
</script>
2
<template>
    <v-app-bar
        v-if="appbar.model"
        :elevation="2"

        :model-value="appbar.model"
        app
        scroll-behavior="hide"
        scroll-threshold="10"
    >
        <v-app-bar-nav-icon
            color="muted"
            @click="sideBarToggle()"
        ></v-app-bar-nav-icon>

        <v-spacer></v-spacer>

        <user-is-logged-in>
            <!-- <v-menu
                v-if="$route.name === 'dashboard'"
                class="d-flex justify-end ml-10"
                min-width="200px"
                transition="slide-y-transition"
            > -->
            <v-menu
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
                                    <v-avatar color="#03A9F4" size="default">
                                        <span class="text-h6">{{
                                            userInitials
                                        }}</span>
                                    </v-avatar>
                                    <div
                                        class="d-none d-md-block ms-3 me-5 pe-5"
                                    >
                                        <!-- <p
                                            class="body-1 mb-0 text--truncate"
                                            v-text="'test'"
                                        ></p> -->
                                        <!-- <div
                                            class="muted--text overline"
                                            v-text="'superadmin'"
                                        ></div> -->
                                        <p class="dp-name">{{ userData }}</p>
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
