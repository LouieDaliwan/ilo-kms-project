<script>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import MetaTag from "@/Components/Metatag/Metatag.vue";
import { useDisplay } from "vuetify";
import { ref } from "vue";

export default {
    name: "Dashboard",

    components: {
        Admin,
        PageHeader,
        MetaTag,
    },

    setup() {
        const display = ref(useDisplay());
        return { display };
    },
};
</script>

<template>
    <admin>
        <meta-tag :title="'Dashboard'"></meta-tag>

        <page-header>
            <template v-slot:action>
                <v-btn
                    :to="{ name: 'members.index' }"
                    block="d.sm-and-down"
                    color="primary"
                    exact
                    large
                >
                    <v-icon left small
                        >mdi-file-document-box-search-outline
                    </v-icon>
                    {{ "All Members" }}
                </v-btn>
            </template>
        </page-header>
    </admin>
</template>
