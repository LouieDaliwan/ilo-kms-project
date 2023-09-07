<script>
import { useRepeaterStore } from "./store/repeater.js";

export default {
    name: "Repeater",
    emits: ["update:modelValue"],

    props: {
        modelValue: {
            type: [Array, Object],
        },

        backgroundDetails: {
            type: [String, Boolean, Object, Array],
        },

        addButtonText: {
            type: String,
            default: "Add Item",
        },
        addButtonIcon: {
            type: String,
            default: "mdi-plus-circle-outline",
        },
        fields: {
            type: [Number, String],
            default: 0,
        },
        autofocus: {
            type: Boolean,
        },
        dense: {
            type: Boolean,
        },
    },
    setup() {
        const repeater = useRepeaterStore();
        return {
            repeater,
        };
    },
    data() {
        return {
            focus: false,
        };
    },
    mounted() {
        this.addUserDefinedDefault();
    },
    computed: {
        isLarge() {
            return !this.dense;
        },
        repeatersIsEmpty() {
            return window._.isEmpty(this.repeaters);
        },
        repeatersIsNotEmpty() {
            return !this.repeatersIsEmpty;
        },
        repeaters: {
            get() {
                return Object.values(this.modelValue || {});
            },
            set(value) {
                this.$emit("update:modelValue", value);
            },
        },
    },
    watch: {
        autofocus(val) {
            this.focus = parseInt(val);
        },
        repeatersX: {
            handler: function (val) {
                this.$emit("update:modelValue", val);
            },
            deep: true,
        },
    },

    methods: {
        add(focus = true) {
            this.repeaters.push(Object.assign({}, this.repeater.getTemplate));
            this.repeaters = Object.assign({}, this.repeaters);
            this.focusOnAdd(focus);
        },
        remove(i) {
            this.repeaters.splice(i, 1);
            this.repeaters = Object.assign({}, this.repeaters);
        },
        addUserDefinedDefault() {
            let fields = parseInt(this.fields);
            for (let i = fields - 1; i >= 0; i--) {
                this.add(false);
            }
        },
        focusOnAdd(val = true) {
            this.focus = val;
        },
    },
};
</script>
<template>
    <section>
        <template v-if="repeatersIsEmpty">
            <slot name="empty">
                <div class="text-center">
                    <v-card-text style="filter: grayscale(0.8)">
                        <empty-icon
                            class="primary--text"
                            height="280"
                            width="300"
                        />
                    </v-card-text>
                    <v-card-text>
                        <slot name="text">
                            <p
                                class="muted--text font-weight-bold mb-0"
                                v-text="'No Items yet'"
                            ></p>
                            <p
                                class="muted--text"
                                v-text="'Start adding key-value pairs.'"
                            ></p>

                            <!--                    v-model="$store.getters['shortkey/ctrlIsPressed']"-->
                            <v-badge
                                bordered
                                bottom
                                class="dt-badge pa-0"
                                color="dark"
                                offset-x="20"
                                offset-y="20"
                                tile
                                transition="fade-transition"
                            >
                                <template v-slot:badge>
                                    <div class="small" style="font-size: 11px">
                                        d
                                    </div>
                                </template>

                                <!--                                                v-shortkey="['ctrl', 'd']" @shortkey="add()"-->
                                <v-btn
                                    class="mt-3"
                                    rounded="xl"
                                    size="x-large"
                                    type="submit"
                                    @click.prevent="add()"
                                >
                                    <v-icon left small
                                        >{{ addButtonIcon }}
                                    </v-icon>

                                    addButtonText
                                </v-btn>
                            </v-badge>
                        </slot>
                    </v-card-text>
                </div>
            </slot>
        </template>
        <v-row v-for="(item, i) in repeaters" :key="i" align="center">
            <v-col md="4" sm="6">
                <!--              v-shortkey.avoid-->
                <!--              hide-details-->
                <v-text-field
                    v-model="item.key"
                    :autofocus="focus"
                    :dense="dense"
                    autocomplete="off"
                    class="dt-text-field dt-repeater--key"
                    label="Key"
                    outlined
                    prepend-inner-icon="mdi-square-edit-outline"
                >
                </v-text-field>
            </v-col>
            <v-col>
                <!--              hide-details-->
                <v-text-field
                    v-model="item.value"
                    :dense="dense"
                    autocomplete="off"
                    class="dt-text-field dt-repeater--value"
                    label="Value"
                    outlined
                ></v-text-field>
            </v-col>
            <v-col cols="auto">
                <context-prompt>
                    <v-card max-width="280">
                        <v-card-title>Remove Item</v-card-title>
                        <v-card-text
                            >Doing so will permanently remove the key-value pair
                            from the list. Are you sure you want to proceed?,
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="error"
                                large
                                text
                                @click.prevent="remove(i)"
                                >Remove
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </context-prompt>
            </v-col>
        </v-row>
        <v-row v-if="repeatersIsNotEmpty" no-gutters>
            <v-col>
                <slot :on="{ on: add }" name="action">
                    <!--                  v-model="$store.getters['shortkey/ctrlIsPressed']"-->
                    <v-badge
                        bottom
                        class="dt-badge"
                        color="dark"
                        offset-x="20"
                        offset-y="20"
                        tile
                        transition="fade-transition"
                    >
                        <template v-slot:badge>
                            <div class="small" style="font-size: 11px">d</div>
                        </template>
                        <!--                      v-shortkey="['ctrl', 'd']"-->
                        <!--                      @shortkey="add()"-->
                        <v-btn class="mt-3" rounded="xl" @click="add()">
                            <v-icon left small>{{ addButtonIcon }}</v-icon>
                            addButtonText
                        </v-btn>
                    </v-badge>
                </slot>
            </v-col>
        </v-row>
    </section>
</template>
