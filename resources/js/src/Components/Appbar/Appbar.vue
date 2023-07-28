<template>
    <v-app-bar
        :clipped-left="false"
        :height="83"
        app
        flat
        hide-on-scroll="d.md-and-up"
    >
        <template v-slot:prepend>
            <v-badge
                bordered
                bottom
                class="dt-badge"
                color="dark"
                offset-x="20"
                offset-y="20"
                tile
                transition="fade-transition"
            >
                <v-app-bar-nav-icon></v-app-bar-nav-icon>
            </v-badge>
        </template>

        <v-spacer></v-spacer>

        <slot></slot>
    </v-app-bar>
</template>

<script>
import { ref } from "vue";
import { useDisplay } from "vuetify";

export default {
    name: "Appbar",

    data() {
        return {};
    },

    setup() {
        const display = ref(useDisplay());
        return { display };
    },
};
</script>
