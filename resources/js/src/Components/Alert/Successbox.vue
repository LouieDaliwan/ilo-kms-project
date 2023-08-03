<script>
import { useSuccessBoxStore } from "./store/successbox.js";

export default {
    setup() {
        const successBoxStore = useSuccessBoxStore();

        return {
            successBoxStore,
        };
    },
    computed: {
        successbox() {
            return this.successBoxStore.successbox;
        },
        show: {
            get() {
                return this.successbox.show;
            },
            set(val) {
                return this.successbox.set({ show: val });
            },
        },
    },
};
</script>
<template>
    <v-alert
        v-model="show"
        :border="successbox.border"
        :color="successbox.color || successbox.type"
        :dense="successbox.dense"
        :dismissible="successbox.dismissible"
        :icon="successbox.icon"
        :outlined="successbox.outlined"
        :prominent="successbox.prominent"
        :type="successbox.type"
        text
    >
        <v-row align="center">
            <v-col class="grow">
                <div
                    v-if="successbox.text"
                    class="font-weight-bold text--success mb-4"
                    v-text="successbox.text"
                ></div>
            </v-col>

            <slot>
                <!--                <can :code="susccessbox.buttons.show.code">-->
                <router-link
                    :to="successbox.buttons.show.to"
                    class="dt-link text--decoration-none mr-6"
                    tag="a"
                >
                    <v-icon left small>
                        {{ successbox.buttons.show.icon }}
                    </v-icon>

                    {{ successbox.buttons.show.text }}
                </router-link>
                <!--                </can>-->

                <!--                <can :code="successbox.buttons.create.code">-->
                <router-link
                    :to="successbox.buttons.create.to"
                    class="dt-link text--decoration-none mr-6"
                    exact
                    tag="a"
                >
                    <v-icon left small
                        >{{ successbox.buttons.create.icon }}
                    </v-icon>
                    {{ successbox.buttons.create.text }}
                </router-link>
                <!--                </can>-->
            </slot>
        </v-row>
    </v-alert>
</template>
