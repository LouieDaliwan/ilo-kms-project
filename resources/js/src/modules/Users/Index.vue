<script setup>
import $api from "./routes/api";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDisplay } from "vuetify";
import { computed, onBeforeMount, onMounted, reactive, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { VDataTable } from "vuetify/labs/VDataTable";

const dialogStore = useDialogStore();
const snackbarStore = useSnackbarStore();
const { smAndDown } = useDisplay();

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
        // rowsPerPage: [5, 10, 15, 20, 50, 100],
    },
    meta: {},
    modes: {
        bulkedit: false,
    },
    selected: [],
    headers: [
        {
            text: "Account Name",
            align: "left",
            class: "text-no-wrap",
            key: "displayname",
        },
        {
            text: "Role",
            class: "text-no-wrap",
            key: "role",
        },
        {
            text: "Last Modified",
            class: "text-no-wrap",
            key: "modified_at",
        },
        {
            text: "Actions",
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
    search: "",
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
};

const getPaginatedData = (params = null, caller = null) => {
    params = Object.assign(params ? params : route.query, {
        search: resources.search,
    });

    resources.loading = true;

    axios
        .get(api.list(), { params })
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
            dialogStore.error({
                width: 400,
                buttons: { cancel: { show: false } },
                title: "Whoops! An error occured",
                text: err.response.data.message,
            });
        })
        .finally(() => {
            resources.data.map(function (data) {
                return Object.assign(data, { loading: false });
            });
        });
};

onBeforeMount(() => {
    getPaginatedData();
});

onMounted(() => {
    changeOptionsFromRouterQueries();
});

const resourcesIsEmpty = computed(() => {
    return window._.isEmpty(resources.data) && !resources.loading;
});

const resourcesIsNotEmpty = computed(() => {
    return !resourcesIsEmpty.value;
});

const options = computed(() => {
    return {
        per_page: resources.options.itemsPerPage,
        page: resources.options.page,
        sort: resources.options.sortBy[0] || undefined,
        order: resources.options.sortDesc[0] || false ? "desc" : "asc",
    };
});

const optionsChanged = (options) => {
    getPaginatedData(options);
};

const selected = computed(() => {
    return resources.selected.map((item) => item.id);
});

const askUserToDestroyUser = (item) => {};

const goToShowUserPage = (user) => {
    return {
        name: "users.show",
        // params: { id: user.id },
        params: { id: "1" },
    };
};

watch(
    () => resources.data,
    (newValue) => {},
);

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

const search = window._.debounce(function (event) {
    resources.search = event.srcElement.value || "";
    tabletoolbar.isSearch = false;
    if (resources.searching) {
        getPaginatedData(options, "search");
        resources.search = false;
    }
}, 200);

const focusSearchBar = () => {
    this.$refs["tablesearch"].focus();
};

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
        <metatag :title="'Users'"></metatag>

        <page-header>
            <template v-slot:utilities>
                <router-link
                    :to="{ name: 'users.trashed' }"
                    class="dt-link text--decoration-none mr-4"
                    exact
                    tag="a"
                >
                    <v-icon left small>mdi-account-off-outline</v-icon>
                    Deactivated Users
                </router-link>
            </template>

            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    :to="{ name: 'users.create' }"
                    color="primary"
                    large
                    rounded
                >
                    <v-icon left>mdi-plus</v-icon>
                    Add User
                </v-btn>
            </template>
        </page-header>

        <div v-if="resourcesIsNotEmpty">
            <v-card>
                <toolbar-menu
                    :items.sync="tabletoolbar"
                    bulk
                    downloadable
                    trashable
                    @update:search="search"
                    @update:trash="bulkTrashResource"
                >
                </toolbar-menu>
                <v-slide-y-reverse-transition mode="out-in">
                    <v-data-table
                        v-model="resources.selected"
                        v-model:items-per-page="resources.meta.total"
                        :headers="resources.headers"
                        :items="resources.data"
                        :loading="resources.loading"
                        :options.sync="resources.options"
                        :show-select="tabletoolbar.toggleBulkEdit"
                        class="elevation-1"
                        item-value="name"
                        @update:options="optionsChanged"
                    ></v-data-table>
                </v-slide-y-reverse-transition>
            </v-card>
        </div>

        <div v-if="resourcesIsEmpty">
            <toolbar-menu
                :items.sync="tabletoolbar"
                @update:search="resources.search"
            >
            </toolbar-menu>
            <empty-state>
                <template v-slot:actions>
                    <v-btn :to="{ name: 'users.create' }" color="primary" large>
                        <v-icon left small>mdi-account-plus-outline</v-icon>
                        Add user
                    </v-btn>
                </template>
            </empty-state>
        </div>
    </admin>
</template>
