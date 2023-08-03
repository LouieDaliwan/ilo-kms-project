<script>
import Admin from "@components/Layouts/Admin.vue";
import Metatag from "@components/Metatag/Metatag.vue";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDialogStore } from "@components/Dialog/store/dialog.js";

export default {
    components: {
        Admin,
        Metatag,
    },

    setup() {
        const snackbar = useSnackbarStore();
        const dialog = useDialogStore();

        return {
            snackbar,
            dialog,
        };
    },
};
</script>
<template>
    <admin>
        <metatag :title="'Add User'"></metatag>
    </admin>
</template>
