<script setup>
import { computed, onBeforeMount, onMounted, reactive, watch } from "vue";
import $api from "../routes/api.js";
import { useRoute, useRouter } from "vue-router";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { VDataTableServer } from "vuetify/labs/components";

onMounted(() => {
    console.log("test");
    console.log($api);

    // getActivity();
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
    meta: {},
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
        .get($api.participantActivity(router.currentRoute.value.params.id))
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

const goToActivityPage = (item) => {
    router.push({
        name: "wise.show-activity",
        params: { activity_id: item.columns.id },
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
    <div>
        <h1>Activity Plus Report</h1>
        <v-card>
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
    </div>
</template>
