`
<script>
import { useDisplay } from "vuetify";

export default {
    name: "Appbar",

    data() {
        return {};
    },

    setup() {
        const { mdAndUp } = useDisplay();
        return { mdAndUp };
    },
};
</script>

<template>
    <v-app-bar
        :clipped-left="true"
        :elevation="2"
        :height="83"
        :hide-on-scroll="!!mdAndUp"
        app
        flat
    >
        <v-spacer></v-spacer>

        <user-is-logged-in>
            <v-menu
                class="justify-end d-flex"
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
                                    class="d-flex justify-space-between align-center"
                                >
                                    <v-avatar class="mr-3" size="32"
                                        ><img :src="''" width="40px"
                                    /></v-avatar>
                                    <div class="d-none d-md-block">
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
                    <v-list-item>
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
`
