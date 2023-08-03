<script>
import ErrorBox from "./ErrorBox.vue";
import SuccessBox from "./Successbox.vue";
import { useAlertBoxStore } from "./store/alertbox.js";
import { useSuccessBoxStore } from "./store/successbox.js";
import { useErrorBoxStore } from "./store/errorbox.js";

export default {
    name: "AlertBox",

    components: {
        ErrorBox,
        SuccessBox,
    },

    setup() {
        const alertBoxStore = useAlertBoxStore();
        const successBoxStore = useSuccessBoxStore();
        const errorBoxStore = useErrorBoxStore();

        return {
            alertBoxStore,
            successBoxStore,
            errorBoxStore,
        };
    },
    computed: {
        actionWasSuccessful() {
            return this.$route.query.success;
        },
    },
    mounted() {
        this.errorBoxStore.hide({});

        if (!this.actionWasSuccessful) this.successBoxStore.hide({});
    },
};
</script>

<template>
    <div class="dt-alertbox">
        <error-box></error-box>
        <success-box></success-box>
    </div>
</template>
