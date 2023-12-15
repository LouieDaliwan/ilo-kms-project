<script>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import MetaTag from "@/Components/Metatag/Metatag.vue";
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";

export default {
    name: "Dashboard",

    components: {
        Admin,
        PageHeader,
        MetaTag,
    },

    setup() {
        const { smAndDown } = useDisplay();

        const onSubmit = () => {
            axios
                .post(
                    $api.uploadParticipants(),
                    {},
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    },
                )
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        return { smAndDown, onSubmit };
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

        <v-form
            ref="addform-form"
            autocomplete="false"
            enctype="multipart/form-data"
            @submit.prevent="onSubmit"
        >
            <button ref="submit-button" type="submit">Save</button>
        </v-form>
    </admin>
</template>
