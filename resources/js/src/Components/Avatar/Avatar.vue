<script setup>
import { onMounted, ref } from "vue";
import { useAvatarStore } from "./store/avatar.js";

const dataset = ref({});
const avatar = useAvatarStore();

onMounted(() => {
    dataset.value = Object.assign({}, avatar);
});
</script>
<template>
    <div class="d-flex justify-center align-center">
        <div class="dt-avatar-preview">
            <v-avatar size="160">
                <img :src="dataset.avatar" alt="" />
            </v-avatar>
        </div>
    </div>
</template>
