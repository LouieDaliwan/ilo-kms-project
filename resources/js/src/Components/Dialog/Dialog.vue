<script>
import { useDialogStore } from "./store/dialog.js";

export default {
    name: "DialogBox",

    props: ["width"],

    computed: {
        show: {
            get() {
                return this.dialog.show;
            },
            set(val) {
                this.dialogStore.prompt({ show: val });
            },
        },
        persistent() {
            return window._.clone(this.dialogStore.persistent);
        },
        text() {
            if (this.dialogStore.text instanceof Array) {
                return this.dialogStore.text
                    .map((text) => {
                        return "<p>" + this.trans(text) + "</p>";
                    })
                    .join("");
            }

            return this.dialogStore.text;
        },
    },

    setup() {
        const dialogStore = useDialogStore();
        return { dialogStore };
    },
};
</script>
<template>
    <v-dialog
        v-model="show"
        :max-width="dialogStore.maxWidth"
        :persistent="persistent"
        :width="width || dialogStore.width"
        scrollable
    >
        <v-card
            :class="{ 'text-xs-center': dialogStore.alignment == 'center' }"
            :dark="dialogStore.dark"
        >
            <v-card-text>
                <slot name="illustration">
                    <div
                        :class="`${dialogStore.color}--text`"
                        class="text-center pa-1"
                    >
                        <component
                            :is="dialog.illustration"
                            :height="dialog.illustrationHeight"
                            :width="dialog.illustrationWidth"
                        ></component>
                    </div>
                </slot>
                <v-card-title class="px-0">
                    <slot name="title">{{ dialogStore.title }}</slot>
                </v-card-title>
                <slot name="text">
                    <div v-html="text"></div>
                </slot>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    v-if="dialogStore.buttons.cancel.show"
                    :color="dialogStore.buttons.cancel.color"
                    text
                    @click.native="dialogStore.buttons.cancel.callback"
                >
                    {{ dialogStore.buttons.cancel.text }}
                </v-btn>

                <v-btn
                    v-if="dialogStore.buttons.action.show"
                    :color="dialogStore.buttons.action.color"
                    :disabled="dialogStore.loading"
                    :loading="dialogStore.loading"
                    text
                    @click.native="dialogStore.buttons.action.callback"
                >
                    {{ dialogStore.buttons.action.text }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
