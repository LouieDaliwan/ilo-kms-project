<script>
import { useMetatagStore } from "./store/metatag.js";

export default {
    props: ["title", "description"],

    watch: {
        title: {
            handler(val) {
                this.setMetaTitle(val);
            },
        },
        description: {
            handler(val) {},
        },
    },
    methods: {
        setMetaTitle(val = null) {
            this.metatagStore.title(val);
            document.title = val;
        },

        setMetaDescription(val = null) {
            this.metatagStore.description(val);

            const domMeta = document.querySelector(
                'head meta[name="description"]',
            );

            domMeta.setAttribute("content", val);
        },
    },

    setup() {
        const metatagStore = useMetatagStore();

        return {
            metatagStore,
        };
    },

    mounted() {
        this.setMetaTitle(this.title);
        this.setMetaDescription(this.$route.meta.description);
    },
};
</script>
<template>
    <keep-alive></keep-alive>
</template>
