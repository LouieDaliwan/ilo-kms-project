<script lang="ts" setup>
import { ref } from "vue";
import { vInfiniteScroll } from "@vueuse/components";

const data = ref([1, 2, 3, 4, 5, 6]);

function onLoadMore() {
    const length = data.value.length + 1;
    data.value.push(...Array.from({ length: 5 }, (_, i) => length + i));
}
</script>

<template>
    <div v-infinite-scroll="[onLoadMore, { distance: 10 }]">
        <div v-for="item in data" :key="item">
            {{ item }}
        </div>
    </div>
</template>
