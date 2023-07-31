<script>
import { useDialogStore } from "./store/dialog.js";

export default {
    props: [],

    setup() {
        const dialogStore = useDialogStore();
        return { dialogStore };
    },
};
</script>
<template>
    <v-dialog> </v-dialog>
</template>
