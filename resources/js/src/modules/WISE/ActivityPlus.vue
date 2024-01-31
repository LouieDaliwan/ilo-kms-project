<script setup>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";
import { computed, onBeforeMount, onMounted, reactive, ref, watch } from "vue";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useRoute, useRouter } from "vue-router";
import { VDataTableServer } from "vuetify/labs/components";
import { useForm } from "vee-validate";
import { uploadSchema } from "./Schema/uploadvalidation.js";
// import VueDatePicker from '@vuepic/vue-datepicker';
import "@vuepic/vue-datepicker/dist/main.css";
import Swal from "sweetalert2";

const { defineComponentBinds, resetForm, handleSubmit, meta } = useForm({
    validationSchema: uploadSchema,
});

const vuetifyConfig = (state) => ({
    props: {
        "error-messages": state.errors,
    },
});

const upload = defineComponentBinds("file_upload", vuetifyConfig);

const fileUpload = ref([]);

const dialogBox = reactive({ dialog: false });

const date = ref(null);

onMounted(() => {
    const startDate = new Date();
    //   const endDate = new Date(new Date().setDate(startDate.getDate()));
    const endDate = new Date();
    date.value = [startDate, endDate];
});

function uploadModal() {
    dialogBox.dialog = true;
}

const { smAndDown } = useDisplay();

const file = ref(null);

const uploadFile = (event) => {
    file.value = event.target.files[0];
    // console.log(file.value)
};

// const test = () => {
//     console.log(fileUpload.value.length)
//     console.log(meta.value.valid)
// }

const clearData = () => {
    resetForm();
};

const onSubmit = handleSubmit(async (values) => {
    const formData = new FormData();
    formData.append("file", file.value);
    await axios
        .post($api.uploadActivityPlus(), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(({ data }) => {
            resetForm();
        })
        .catch((err) => {
            console.log(err);
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

const dialogStore = useDialogStore();
const snackbarStore = useSnackbarStore();
const router = useRouter();
const route = useRoute();

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
    meta: {
        total: 0,
    },
    modes: {
        bulkedit: false,
    },
    selected: [],
    headers: [
        {
            id: "ID No.",
            align: "left",
            class: "text-no-wrap",
            key: "id",
        },
        {
            title: "Name",
            align: "left",
            class: "text-no-wrap",
            key: "company_name",
        },

        {
            title: "Date Training",
            class: "text-no-wrap",
            key: "dateOfTraining",
        },
        {
            title: "Actions",
            align: "center",
            sortable: false,
            class: "muted--text text-no-wrap",
            key: "action",
        },
    ],
    data: [],
});

const tabletoolbar = reactive({
    bulkCount: 0,
    isSearching: false,
    searchInput: "",
    listGridView: false,
    toggleBulkEdit: false,
    toggleTrash: false,
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
        .get(api.activityReports(), { params })
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

const isDisabledComputed = computed(() => {
    return meta.value.valid;
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

const goToActivityPage = (item) => {
    router.push({
        name: "wise.show-activity",
        params: { activity_id: item.columns.id },
        // params: { activity_id: item.id },
    });
};

watch(
    () => resources.search,
    (newValue) => {
        resources.searching = true;
    },
);

watch(
    () => resources.selected,
    (newValue) => {
        tabletoolbar.bulkCount = newValue.length;
    },
);

watch(
    () => tabletoolbar.toggleBulkEdit,
    (newValue) => {
        resources.selected = [];
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

const bulkTrashResource = () => {
    let selected = selected;
    axios
        .delete($api.destroy(null), { data: { id: selected } })
        .then(({ data }) => {
            getPaginatedData(null, "bulkTrashResource");
            tabletoolbar.toggleTrash = false;
            tabletoolbar.toggleBulkEdit = false;
            dialogStore.hide();
            snackbarStore.show({
                text: `User successfully deactivated ${tabletoolbar.bulkCount}`,
            });
        })
        .catch((err) => {
            dialogStore.error({
                width: 400,
                buttons: { cancel: { show: false } },
                title: "Whoops! An error occured",
                text: err.response.data.message,
            });
        });
};
</script>

<template>
    <admin>
        <metatag :title="'Wise Activity'"></metatag>

        <page-header>
            <template v-slot:title> WISE Activity Plus</template>

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
                @update:trash="bulkTrashResource"
            >
            </toolbar-menu>
            <!-- <v-row>
                <v-col class="d-flex">
                    <VueDatePicker
                        v-model="date"
                        :enable-time-picker="false"
                        :teleport="true"
                        class="mb-20"
                        position="left"
                        range
                    />
                </v-col>
            </v-row> -->
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

                        <template v-slot:item.updated_at="{ item }">
                            <span
                                :title="item.updated_at"
                                class="text-no-wrap"
                                >{{ item.modified_at }}</span
                            >
                        </template>

                        <template v-slot:item.action="{ item }">
                            <div class="text-no-wrap">
                                <!-- Edit User -->
                                <!-- <v-tooltip bottom>-->
                                <v-btn
                                    class="me-0 btn-actions"
                                    @click.prevent="goToActivityPage(item)"
                                >
                                    <v-icon small>mdi-pencil-outline</v-icon>
                                </v-btn>
                                <!-- Edit User -->
                            </div>
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
