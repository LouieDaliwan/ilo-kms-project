<script>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import MetaTag from "@/Components/Metatag/Metatag.vue";
import { useDisplay } from "vuetify";

export default {
    name: "Dashboard",

    components: {
        Admin,
        PageHeader,
        MetaTag,
    },

    setup() {
        const { smAndDown } = useDisplay();
        return { smAndDown };
    },
};
</script>

<template>
    <admin>
        <meta-tag :title="'Dashboard'"></meta-tag>
        <h1 class="text-primary text-center mt-5">
            Welcome to ILO Dashboard
        </h1>
        <v-container class="text-center mt-8">
            <img alt="ilo logo" class="img-fluid" :src="'/images/welcome-img.png'"/>
        </v-container>
        <page-header></page-header>
    </admin>
</template>
