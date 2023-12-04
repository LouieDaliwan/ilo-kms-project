<script>
export default {
    props: [
        "modelValue",
        "disabled",
        "isDense",
        "label",
        "name",
        "attributeName",
    ],
    emits: ["update:modelValue"],

    computed: {
        resource: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit("update:modelValue", val);
            },
        },
    },
};
</script>

<template>
    <v-text-field
        v-model="resource"
        :dense="isDense"
        :disabled="disabled"
        :label="label"
        :name="name"
        class="dt-text-field"
        dense
        hide-details
        outlined
        v-bind="attributeName"
    ></v-text-field>
</template>
