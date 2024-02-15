<script setup>
import $api from "../routes/api";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDisplay } from "vuetify";
import { computed, onBeforeMount, onMounted, reactive, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { VDataTableServer } from "vuetify/labs/components";
import { useForm } from "vee-validate";
import { uploadSchema } from "@modules/WISE/Schema/uploadvalidation";
import Swal from "sweetalert2";
import "@vuepic/vue-datepicker/dist/main.css";

const { defineComponentBinds, resetForm, handleSubmit, setErrors, meta } =
    useForm({
        validationSchema: uploadSchema,
    });

const vuetifyConfig = (state) => ({
    props: {
        "error-messages": state.errors,
    },
});

const upload = defineComponentBinds("file_upload", vuetifyConfig);

const fileUpload = ref([]);

const dialogStore = useDialogStore();
const snackbarStore = useSnackbarStore();
const { smAndDown } = useDisplay();

const router = useRouter();
const route = useRoute();

const dialogBox = reactive({ dialog: false });

onMounted(() => {});

function uploadModal() {
    dialogBox.dialog = true;
}

const resources = reactive({
    loading: false,
    search: "",
    options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        sortDesc: [],
        sortBy: [],
    },
    meta: {},
    modes: {
        bulkedit: false,
    },
    selected: [],
    headers: [
        {
            title: "ID No.",
            align: "left",
            class: "text-no-wrap",
            key: "id",
        },
        {
            title: "Name",
            align: "left",
            class: "text-no-wrap",
            key: "fullname",
        },
        {
            title: "Gender",
            class: "text-no-wrap",
            key: "gender",
        },
        {
            title: "Age",
            align: "center",
            sortable: false,
            class: "muted--text text-no-wrap",
            key: "age",
        },
        {
            title: "High Education",
            class: "text-no-wrap",
            key: "high_education",
        },
        {
            title: "Trainer",
            class: "text-no-wrap",
            key: "trainer",
        },
        {
            title: "Location",
            class: "text-no-wrap",
            key: "location",
        },
        {
            title: "Trainer Batch Code",
            class: "text-no-wrap",
            key: "trainer_batch_code",
        },
    ],
    data: [],
});

const tabletoolbar = reactive({
    isSearching: false,
    searchInput: "",
    listGridView: false,
    verticaldiv: false,
});

const api = $api;

const changeOptionsFromRouterQueries = () => {
    options.per_page = route.query.per_page;
    options.page = parseInt(route.query.page);
    options.search = route.query.search;
    resources.search = options.search;
    tabletoolbar.search = options.search;

    getPaginatedData();
};

const getPaginatedData = (params = null, caller = null) => {
    params = Object.assign(params ? params : route.query, {
        search: resources.search,
    });

    resources.loading = true;

    axios
        .get(api.listClients(), { params })
        .then((response) => {
            let responseData = response.data;
            resources.data = responseData.data;
            resources.meta = responseData.meta;

            resources.options = Object.assign(
                resources.options,
                response.data.meta,
                params,
            );

            resources.loading = false;

            router
                .push({
                    query: Object.assign({}, route.query, params),
                })
                .catch((err) => {});
        })
        .catch((err) => {
            tabletoolbar.isSearching = false;
            resources.loading = false;
            dialogStore.error({
                width: 400,
                buttons: { cancel: { show: false } },
                title: "Whoops! An error occured",
                text: "Error",
            });
        })
        .finally(() => {
            resources.data.map(function (data) {
                return Object.assign(data, { loading: false });
            });
        });
};

onBeforeMount(() => {
    changeOptionsFromRouterQueries();
});

const resourcesIsEmpty = computed(() => {
    return window._.isEmpty(resources.data) && !resources.loading;
});

const resourcesIsNotEmpty = computed(() => {
    return !resourcesIsEmpty.value;
});

const options = reactive({
    per_page: resources.options.itemsPerPage,
    page: resources.options.page,
    sort: resources.options.sortBy[0] || undefined,
    order: resources.options.sortDesc[0] || false ? "desc" : "asc",
});

const optionsChanged = (options) => {
    getPaginatedData(options);
};

watch(
    () => resources.search,
    (newValue) => {
        resources.searching = true;
    },
);

const search = window._.debounce(function (value) {
    resources.search = value || "";
    tabletoolbar.isSearch = false;
    if (resources.searching) {
        getPaginatedData(options, "search");
        resources.search = value || "";
    }
}, 200);

const file = ref(null);

const uploadFile = (event) => {
    file.value = event.target.files[0];
};

const clearData = () => {
    resetForm();
};

const onSubmit = handleSubmit(async () => {
    const formData = new FormData();
    formData.append("file", file.value);

    await axios
        .post($api.uploadClients(), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(({ data }) => {
            resetForm();
            Swal.fire({
                title: "Success!",
                text: "SIYB Clients have been uploaded.",
                icon: "success",
                confirmButtonColor: "#1E2DBE",
            });
        })
        .catch((err) => {
            Swal.fire({
                title: "Error!",
                text: "There's Error Occurred Please Try Again",
                icon: "error",
                confirmButtonColor: "#1E2DBE",
            });
        })
        .finally(() => {
            dialogBox.dialog = false;
            getPaginatedData();
            fileUpload.value = [];
            Swal.fire({
                title: "Success!",
                text: "Data has been uploaded.",
                icon: "success",
                confirmButtonColor: "#1E2DBE",
            });
        });
});

const isDisabledComputed = computed(() => {
    return meta.value.valid;
});
</script>

<template>
    <admin>
        <metatag :title="'Agencies'"></metatag>

        <page-header>
            <template v-slot:title>SIYB Clients</template>

            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    color="primary"
                    large
                    rounded
                    @click="uploadModal"
                >
                    Upload data
                    <v-icon class="ms-2" left>mdi-cloud-upload</v-icon>
                </v-btn>
                <div class="text-center">
                    <v-dialog v-model="dialogBox.dialog" width="500">
                        <v-card>
                            <div class="bg-blue-lighten-5">
                                <v-card-title
                                    class="text-secondary-color font-weight-bold"
                                >
                                    UPLOAD DATA
                                </v-card-title>
                            </div>
                            <small
                                class="font-italic font-weight-thin pt-3 pb-2 px-5"
                                >Please make sure that the fields on the excel
                                file are in order and correct.</small
                            >
                            <v-form
                                enctype="multipart/form-data"
                                @submit.prevent="onSubmit"
                            >
                                <v-card-text>
                                    <v-file-input
                                        v-model="fileUpload"
                                        label="Upload Data"
                                        name="file_upload"
                                        show-size
                                        v-bind="upload"
                                        @change="uploadFile"
                                        @click:clear="clearData"
                                    ></v-file-input>
                                </v-card-text>
                                <v-divider></v-divider>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        :disabled="!isDisabledComputed"
                                        color="primary"
                                        type="submit"
                                    >
                                        Upload
                                    </v-btn>
                                    <!-- <v-btn color="primary" @click="test">
                                        Test
                                    </v-btn> -->
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-dialog>
                </div>
            </template>
        </page-header>
        <v-card>
            <toolbar-menu
                :bulkCount="tabletoolbar.bulkCount"
                :isSearch="tabletoolbar.isSearching"
                :items="tabletoolbar"
                :search="tabletoolbar.searchInput"
                bulk
                downloadable
                trashable
                @update:searchInput="search"
            >
            </toolbar-menu>

            <div v-if="resourcesIsNotEmpty">
                <v-slide-y-reverse-transition mode="out-in">
                    <v-data-table-server
                        v-model:items-per-page="resources.options.itemsPerPage"
                        :headers="resources.headers"
                        :items="resources.data"
                        :items-length="resources.meta.total"
                        :loading="resources.loading"
                        :options.sync="resources.options"
                        :show-select="tabletoolbar.toggleBulkEdit"
                        class="elevation-1"
                        item-value="displayname"
                        @update:options="optionsChanged"
                    >
                        <template v-slot:progress><span></span></template>

                        <template v-slot:loading>
                            <v-slide-y-transition mode="out-in">
                                <div>
                                    <div
                                        v-for="(j, i) in resources.options
                                            .itemsPerPage"
                                        :key="i"
                                    >
                                        <skeleton-table></skeleton-table>
                                    </div>
                                </div>
                            </v-slide-y-transition>
                        </template>
                    </v-data-table-server>
                </v-slide-y-reverse-transition>
            </div>

            <div v-if="resourcesIsEmpty">
                <empty-state></empty-state>
            </div>
        </v-card>
    </admin>
</template>
