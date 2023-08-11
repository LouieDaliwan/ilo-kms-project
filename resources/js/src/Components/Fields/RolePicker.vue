<script>
import { ErrorMessage, Field, useForm } from "vee-validate";
import { userSchema } from "@modules/Users/Schema/uservalidation.js";

export default {
    name: "RolePicker",
    emits: ["update:modelValue"],

    components: {
        ErrorMessage,
        Field,
    },

    props: {
        modelValue: {
            type: [Array, Object, String, Number],
        },
        dense: {
            type: Boolean,
        },
        multiple: {
            type: [Boolean, Number],
        },
        errors: {
            type: [Array, Object],
        },
        lazyLoad: {
            type: Boolean,
        },
    },

    setup() {
        const { defineComponentBinds } = useForm({
            validationSchema: userSchema,
        });

        const vuetifyConfig = (state) => ({
            props: {
                "error-messages": state.errors,
            },
        });

        const rolesValidation = defineComponentBinds("roles", vuetifyConfig);

        return { rolesValidation };
    },

    data() {
        return {
            items: [],
        };
    },
    computed: {
        role: {
            get() {
                return this.modelValue[0];
            },
            set(value) {
                this.$emit("update:modelValue", [value]);
            },
        },
        roles() {
            return this.items.map(function (role) {
                return {
                    name: role.name,
                    id: role.id,
                };
            });
        },
    },
    methods: {
        getRolesData() {
            if (window._.isEmpty(this.items)) {
                this.items = [
                    { id: 1, name: "Admin" },
                    { id: 2, name: "User" },
                ];
            }
        },
    },
    mounted() {
        if (!this.lazyLoad) {
            this.getRolesData();
        }
    },
};
</script>
<template>
    <v-card>
        <v-card-title>Roles</v-card-title>
        <slot name="illustration">
            <div class="secondary--text text-center">
                <shield-with-check-mark-icon></shield-with-check-mark-icon>
            </div>
        </slot>
        <v-card-text>
            <!--          :error-messages="errors"-->
            <!--          menu-props="offsetY"-->
            <v-select
                ref="roles"
                v-model="role"
                :dense="dense"
                :items="roles"
                :label="`Select role ${multiple ? 2 : 1})`"
                :multiple="multiple"
                background-color="selects"
                class="dt-text-field"
                hint="Select Role"
                item-title="name"
                item-value="id"
                name="roles"
                outlined
                persistent-hint
                v-bind="rolesValidation"
                @focus="getRolesData"
            >
            </v-select>
        </v-card-text>
    </v-card>
</template>
