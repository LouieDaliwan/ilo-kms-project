<script>
import { useErrorBoxStore } from "./store/errorbox.js";

export default {
    name: "ErrorBox",

    setup() {
        const errorBoxStore = useErrorBoxStore();

        return {
            errorBoxStore,
        };
    },

    computed: {
        errorbox() {
            return this.errorBoxStore.errorbox;
        },

        errors() {
            return this.errorbox.show;
        },

        show: {
            get() {
                return this.errorbox.show;
            },
            set(val) {
                return this.errorbox.set({ show: val });
            },
        },
    },
};
</script>

<template>
    <v-alert
        v-model="show"
        :border="errorbox.border"
        :color="errorbox.color || errorbox.type"
        :dense="errorbox.dense"
        :dismissible="errorbox.dismissible"
        :icon="errorbox.icon"
        :outlined="errorbox.outlined"
        :prominent="errorbox.prominent"
        :type="errorbox.type"
        text
        transition="scale-transition"
    >
        <v-row align="center">
            <v-col class="grow">
                <div
                    v-if="errorbox.text"
                    class="font-weight-bold text--error mb-4"
                    v-text="errorbox.text"
                ></div>

                <ul v-if="errors.length">
                    <li
                        v-for="error in errors"
                        :key="error"
                        v-text="error"
                    ></li>
                </ul>
            </v-col>
        </v-row>
    </v-alert>
</template>
