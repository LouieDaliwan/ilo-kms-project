<script>
export default {
    props: ["type", "transition"],
};
</script>

<template>
    <v-skeleton-loader
        :transition="transition"
        :type="type"
    ></v-skeleton-loader>
</template>
