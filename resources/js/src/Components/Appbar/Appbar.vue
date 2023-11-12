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
                    <v-btn icon="mdi-dots-vertical" v-bind="props"></v-btn>
                </template>
                <!--                    <v-tooltip bottom>-->
                <!--                        <template v-slot:activator="{ on: tooltip }">-->
                <!--                            <div role="button" v-on="{ ...tooltip, ...menu }">-->
                <!--                                <div-->
                <!--                                    class="d-flex justify-space-between align-center"-->
                <!--                                >-->
                <!--                                    &lt;!&ndash;                                    <v-avatar class="mr-3" size="32"&ndash;&gt;-->
                <!--                                    &lt;!&ndash;                                        ><img :src="user.avatar" width="40px"&ndash;&gt;-->
                <!--                                    &lt;!&ndash;                                    /></v-avatar>&ndash;&gt;-->
                <!--                                    <div class="d-none d-md-block">-->
                <!--                                        &lt;!&ndash;                                        <p&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                            class="body-1 mb-0 text&#45;&#45;truncate"&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                            v-text="user.displayname"&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                        ></p>&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                        <div&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                            class="muted&#45;&#45;text overline"&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                            v-text="user.role"&ndash;&gt;-->
                <!--                                        &lt;!&ndash;                                        ></div>&ndash;&gt;-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </template>-->
                <!--                        &lt;!&ndash;                        <span v-text="user.displayname"></span>&ndash;&gt;-->
                <!--                    </v-tooltip>-->

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
