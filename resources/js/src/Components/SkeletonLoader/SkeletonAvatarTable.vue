<script>
import { VSkeletonLoader } from "vuetify/labs/VSkeletonLoader";

export default {
    components: {
        VSkeletonLoader,
    },
};
</script>
<template>
    <div class="d-flex">
        <v-skeleton-loader
            class="px-4 py-3 mr-4"
            type="avatar"
        ></v-skeleton-loader>
        <v-skeleton-loader
            class="px-4 py-3"
            type="table-row"
            width="100%"
        ></v-skeleton-loader>
    </div>
</template>
