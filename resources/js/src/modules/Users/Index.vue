<script>
import Admin from "@components/Layouts/Admin.vue";
import Metatag from "@components/Metatag/Metatag.vue";
import Man from "@/components/Icons/ManThrowingAwayPaperIcon.vue";
import PageHeader from "@components/Headers/Pageheader.vue";
import ToolbarMenu from "@components/Toolbar/ToolbarMenu.vue";
import EmptyState from "@components/Empty/EmptyState.vue";
import SkeletonAvatarTable from "@components/SkeletonLoader/SkeletonAvatarTable.vue";
import $api from "./routes/api";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { VDataTable } from "vuetify/labs/VDataTable";

import { useDisplay } from "vuetify";

export default {
    components: {
        Admin,
        Metatag,
        Man,
        PageHeader,
        ToolbarMenu,
        EmptyState,
        SkeletonAvatarTable,
        VDataTable,
    },

    setup() {
        const dialogStore = useDialogStore();
        const snackbarStore = useSnackbarStore();
        const { smAndDown } = useDisplay();

        return {
            dialogStore,
            snackbarStore,
            smAndDown,
        };
    },

    data() {
        return {
            api: $api,

            resources: {
                loading: true,
                search: null,
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
                        value: "displayname",
                        class: "text-no-wrap",
                    },
                    {
                        text: "Role",
                        value: "role",
                        class: "text-no-wrap",
                    },
                    {
                        text: "Last Modified",
                        value: "updated_at",
                        class: "text-no-wrap",
                    },
                    {
                        text: "Actions",
                        align: "center",
                        value: "action",
                        sortable: false,
                        class: "muted--text text-no-wrap",
                    },
                ],
                data: [],
            },
            tabletoolbar: {
                bulkCount: 0,
                isSearching: false,
                search: null,
                listGridView: false,
                toggleBulkEdit: false,
                toggleTrash: false,
                verticaldiv: false,
            },
        };
    },

    computed: {
        resourcesIsEmpty() {
            return (
                window._.isEmpty(this.resources.data) && !this.resources.loading
            );
        },

        resourcesIsNotEmpty() {
            return !this.resourcesIsEmpty;
        },

        options: function () {
            return {
                per_page: this.resources.options.itemsPerPage,
                page: this.resources.options.page,
                sort: this.resources.options.sortBy[0] || undefined,
                order:
                    this.resources.options.sortDesc[0] || false
                        ? "desc"
                        : "asc",
            };
        },

        selected: function () {
            return this.resources.selected.map((item) => item.id);
        },
    },

    mounted() {
        this.changeOptionsFromRouterQueries();
    },

    watch: {
        "resources.search": function (val) {
            this.resources.searching = true;
        },

        "resources.selected": function (val) {
            this.tabletoolbar.bulkCount = val.length;
        },

        "tabletoolbar.toggleBulkEdit": function (val) {
            if (!val) {
                this.resources.selected = [];
            }
        },
    },

    methods: {
        changeOptionsFromRouterQueries() {
            this.options.per_page = this.$route.query.per_page;
            this.options.page = parseInt(this.$route.query.page);
            this.options.search = this.$route.query.search;
            this.resources.search = this.options.search;
            this.tabletoolbar.search = this.options.search;
        },

        optionsChanged(options) {
            this.getPaginatedData(this.options);
        },

        getPaginatedData(params = null, caller = null) {
            params = Object.assign(params ? params : this.$route.query, {
                search: this.resources.search,
            });
            this.resources.loading = true;
            axios
                .get(this.api.list(), { params })
                .then((response) => {
                    this.resources = Object.assign(
                        {},
                        this.resources,
                        response.data,
                    );
                    this.resources.options = Object.assign(
                        this.resources.options,
                        response.data.meta,
                        params,
                    );
                    this.resources.loading = false;
                    this.$router
                        .push({
                            query: Object.assign({}, this.$route.query, params),
                        })
                        .catch((err) => {});
                })
                .catch((err) => {
                    this.dialogStore.error({
                        width: 400,
                        buttons: { cancel: { show: false } },
                        title: "Whoops! An error occured",
                        text: err.response.data.message,
                    });
                })
                .finally(() => {
                    this.resources.data.map(function (data) {
                        return Object.assign(data, { loading: false });
                    });
                });
        },

        goToShowUserPage(user) {
            return {
                name: "users.show",
                params: { id: user.id, slug: user.username },
            };
        },

        search: _.debounce(function (event) {
            this.resource.search = event.srcElement.value || "";
            this.tabletoolbar.isSearch = false;
            if (this.resources.searching) {
                this.getPaginatedData(this.options, "search");
                this.resources.search = false;
            }
        }, 200),

        focusSearchBar() {
            this.$refs["tablesearch"].focus();
        },

        bulkTrashResource() {
            let selected = this.selected;
            axios
                .delete($api.destroy(null), { data: { id: selected } })
                .then(({ data }) => {
                    this.getPaginatedData(null, "bulkTrashResource");
                    this.tabletoolbar.toggleTrash = false;
                    this.tabletoolbar.toggleBulkEdit = false;
                    this.dialogStore.hide();
                    this.snackbarStore.show({
                        text: `User successfully deactivated ${this.tabletoolbar.bulkCount}`,
                    });
                })
                .catch((err) => {
                    this.dialogStore.error({
                        width: 400,
                        buttons: { cancel: { show: false } },
                        title: "Whoops! An error occured",
                        text: err.response.data.message,
                    });
                });
        },
        askUserToDestroyUser(item) {
            this.dialogStore.show({
                color: "warning",
                illustration: Man,
                illustrationWidth: 200,
                illustrationHeight: 160,
                width: "420",
                title: "You are about to move to trash the selected user.",
                text: [
                    "The user will be signed out from the app. Some data related to the account like comments and files will still remain.",
                    `Are you sure you want to move ${item.displayname} to Trash?`,
                ],
                buttons: {
                    cancel: { show: true, color: "link" },
                    action: {
                        text: "Move to Trash",
                        color: "warning",
                        callback: (dialog) => {
                            this.dialogStore.loading(true);
                            this.destroyResource(item);
                        },
                    },
                },
            });
        },
        destroyResource(item) {
            item.loading = true;
            axios.delete($api.destroy(item.id)).then(({ data }) => {
                item.active = false;
                this.getPaginatedData(null, "destroyResource");
                this.snackbarStore.show({
                    text: `User successfully deactivated`,
                });
                this.dialogStore.hide();
            });
        },
    },
};
</script>
<template>
    <admin>
        <metatag :title="'Users'"></metatag>

        <page-header>
            <!--            <template v-slot:utilities>-->
            <!--                <router-link-->
            <!--                    :to="{ name: 'users.trashed' }"-->
            <!--                    class="dt-link text&#45;&#45;decoration-none mr-4"-->
            <!--                    exact-->
            <!--                    tag="a"-->
            <!--                >-->
            <!--                    <v-icon left small>mdi-account-off-outline</v-icon>-->
            <!--                    Deactivated Users-->
            <!--                </router-link>-->
            <!--            </template>-->

            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    :to="{ name: 'users.create' }"
                    color="primary"
                    exact
                    large
                    rounded
                >
                    <v-icon left>mdi-plus</v-icon>
                    Add User
                </v-btn>
            </template>
        </page-header>

        <div v-show="resourcesIsNotEmpty">
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
                        :headers="resources.headers"
                        :items="resources.data"
                        :items-length="resources.meta.total"
                        :loading="resources.loading"
                        :mobile-breakpoint="NaN"
                        :options.sync="resources.options"
                        :show-select="tabletoolbar.toggleBulkEdit"
                        color="primary"
                        item-key="id"
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
                                        <skeleton-avatar-table></skeleton-avatar-table>
                                    </div>
                                </div>
                            </v-slide-y-transition>
                        </template>

                        <!-- Avatar and Displayname -->
                        <template v-slot:item.displayname="{ item }">
                            <div class="d-flex align-items-center">
                                <v-tooltip v-if="auth.id == item.id" bottom>
                                    <!--                                <v-tooltip v-if="auth.id == item.id" bottom>-->
                                    <template v-slot:activator="{ on }">
                                        <v-badge
                                            avatar
                                            bordered
                                            color="muted"
                                            offset-x="35"
                                            offset-y="15"
                                            overlap
                                        >
                                            <template v-slot:badge>
                                                <v-avatar>
                                                    <i
                                                        class="small mdi mdi-home-account"
                                                        style="font-size: 12px"
                                                    ></i>
                                                </v-avatar>
                                            </template>
                                            <v-avatar
                                                class="mr-6"
                                                color="workspace"
                                                size="32"
                                                v-on="on"
                                            >
                                                <v-img
                                                    :src="item.avatar"
                                                ></v-img>
                                            </v-avatar>
                                        </v-badge>
                                    </template>
                                    <span> This is your account </span>
                                </v-tooltip>
                                <v-avatar
                                    v-else
                                    class="mr-6"
                                    color="workspace"
                                    size="32"
                                >
                                    <v-img :src="item.avatar"></v-img>
                                </v-avatar>

                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <span class="mt-1" v-on="on"
                                            ><router-link
                                                :to="goToShowUserPage(item)"
                                                class="text-no-wrap text--decoration-none"
                                                exact
                                                tag="a"
                                                v-text="item.displayname"
                                            ></router-link
                                        ></span>
                                    </template>
                                    <span>View Details</span>
                                </v-tooltip>
                            </div>
                        </template>
                        <!-- Avatar and Displayname -->

                        <!-- Modified -->
                        <template v-slot:item.updated_at="{ item }">
                            <span
                                :title="item.updated_at"
                                class="text-no-wrap"
                                >{{ trans(item.modified) }}</span
                            >
                        </template>
                        <!-- Modified -->

                        <!-- Action buttons -->
                        <template v-slot:item.action="{ item }">
                            <div class="text-no-wrap">
                                <!-- Edit -->
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            :to="{
                                                name: 'users.show',
                                                params: { id: item.id },
                                            }"
                                            icon
                                            v-on="on"
                                        >
                                            <v-icon small
                                                >mdi-pencil-outline
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Edit this user</span>
                                </v-tooltip>
                                <!-- Edit -->
                                <!-- Move to Trash -->
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            icon
                                            @click="askUserToDestroyUser(item)"
                                            v-on="on"
                                        >
                                            <v-icon small
                                                >mdi-delete-outline
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Deactivate user</span>
                                </v-tooltip>
                                <!-- Move to Trash -->
                            </div>
                        </template>
                        <!-- Action buttons -->
                    </v-data-table>
                </v-slide-y-reverse-transition>
            </v-card>
        </div>

        <div v-if="resourcesIsEmpty">
            <toolbar-menu :items.sync="tabletoolbar" @update:search="search">
            </toolbar-menu>
            <empty-state>
                <template v-slot:actions>
                    <v-btn
                        :to="{ name: 'users.create' }"
                        color="primary"
                        exact
                        large
                    >
                        <v-icon left small>mdi-account-plus-outline</v-icon>
                        Add user
                    </v-btn>
                </template>
            </empty-state>
        </div>
    </admin>
</template>
