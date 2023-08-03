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

        <page-header>
            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    :to="{ name: 'users.all' }"
                    color="primary"
                    large
                    rounded
                >
                    <v-icon left small
                        >mdi-file-document-box-search-outline
                    </v-icon>
                    {{ "All Users" }}
                </v-btn>
            </template>
        </page-header>
    </admin>
</template>
