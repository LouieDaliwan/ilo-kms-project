<script>
import ShieldWithCheckMarkIcon from "@components/Icons/ShieldWithCheckMarkIcon.vue";

export default {
    name: "RolePicker",
    emits: ["update:value"],
    components: { ShieldWithCheckMarkIcon },
    props: ["value", "errors", "dense", "multiple", "lazyLoad"],

    data() {
        return {
            items: [],
        };
    },
    computed: {
        role: {
            get() {
                return !window._.isEmpty(this.value)
                    ? this.value[0]
                    : this.value;
            },
            set(value) {
                this.$emit("update:value", value);
            },
        },

        roles() {
            return this.items.map(function (role) {
                return {
                    text: role.name,
                    value: role.id,
                };
            });
        },
    },
    methods: {
        getRolesData() {
            if (window._.isEmpty(this.items)) {
                this.items = [];
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
                :hide-details="true"
                :items="['Superadmin', 'Admin']"
                :label="`Select role ${multiple ? 2 : 1})`"
                :multiple="multiple"
                background-color="selects"
                class="dt-text-field"
                menu-props
                name="roles"
                outlined
                @focus="getRolesData"
            >
            </v-select>
            <input v-model="role" name="roles[]" type="hidden" />
        </v-card-text>
    </v-card>
</template>
