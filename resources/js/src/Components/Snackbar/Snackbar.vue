<script>
import {
    VSlideYReverseTransition,
    VSlideYTransition,
} from "vuetify/components";
import { useSnackbarStore } from "./store/snackbar.js";

export default {
    name: "Snackbar",

    components: {
        slideY: VSlideYTransition,
        slideYReverse: VSlideYReverseTransition,
    },

    setup() {
        const snackbar = useSnackbarStore();

        return {
            snackbar,
        };
    },

    computed: {
        slideTransition() {
            return this.snackbar.y === "bottom" ? "slide-y-reverse" : "slide-y";
        },
        model: {
            get() {
                return this.snackbar.show;
            },
            set(show) {
                this.snackbar.toggle(show);
                return show;
            },
        },
    },

    methods: {
        snackbarCallback() {
            this.snackbar.button.callback();
        },
    },
};
</script>
<template>
    <component :is="slideTransition" mode="out-in">
        <v-snackbar
            v-model="model"
            :bottom="snackbar.y === 'bottom'"
            :color="snackbar.color"
            :left="snackbar.x === 'left'"
            :multi-line="snackbar.mode === 'multi-line'"
            :right="snackbar.x === 'right'"
            :timeout="snackbar.timeout"
            :top="snackbar.y === 'top'"
            :vertical="snackbar.mode === 'vertical'"
        >
            <v-icon v-if="snackbar.icon" class="mr-3" dark small
                >{{ snackbar.icon }}
            </v-icon>
            &nbsp;
            {{ snackbar.text }}

            <v-btn
                v-if="snackbar.button.show"
                dark
                small
                text
                @click="snackbarCallback()"
            >
                <v-icon v-if="snackbar.button.icon" small
                    >{{ snackbar.button.icon }}
                </v-icon>
                <template v-else>{{ snackbar.button.text }}</template>
            </v-btn>
        </v-snackbar>
    </component>
</template>
