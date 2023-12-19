<template>
    <keep-alive>
        <template v-if="userIsNewPassword">
            <slot></slot>
        </template>
        <template v-else>
            <slot name="unpermitted"></slot>
        </template>
    </keep-alive>
</template>

<script>
export default {
    name: "UserIsNewPassword",

    computed: {
        userIsNewPassword() {
            return localStorage.getItem("isTemporaryPassword") === "true";
        },
    },
};
</script>
