<script>
import { defineStore } from "pinia";

export default {
    name: "Metatag",

    props: ["title", "description"],

    watch: {
        title(val) {
            defineStore("metatag/set", {
                title: val,
            });

            document.title = val;
        },
        description(val) {},
    },
};
</script>
<template>
    <keep-alive></keep-alive>
</template>
