<script setup>
import $auth from "@/core/Auth/auth.js";

const props = defineProps(["code"]);

const check = (roles) => {
    if (roles === undefined) {
        return false;
    }

    return roles.includes($auth.role());
};
</script>

<template>
    <keep-alive>
        <template v-if="check(props.code)">
            <slot></slot>
        </template>
        <template v-else>
            <slot name="unpermitted"></slot>
        </template>
    </keep-alive>
</template>
