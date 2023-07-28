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

            console.log("test metatag");
            document.title = val;
        },
        description(val) {
            defineStore("metatag/set", {
                description: val,
            });

            document
                .querySelector('head meta[name="description"]')
                .setAttribute("content", val);
        },
    },
};
</script>
<template>
    <keep-alive></keep-alive>
</template>
