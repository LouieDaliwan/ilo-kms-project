<script>
import { useToolbarStore } from "./store/toolbar.js";

export default {
    name: "ToolbarMenu",

    props: {
        items: [Object, Array],
        default: () => {
            return {};
        },
        bulk: {
            type: [Boolean],
        },
        downloadable: {
            type: [Boolean],
        },
        trashable: {
            type: [Boolean],
        },
        restorable: {
            type: [Boolean],
        },
        deletable: {
            type: [Boolean],
        },
    },

    data() {
        return {
            dataset: {},
            trashButtonIsLoading: false,
            deleteButtonIsLoading: false,
            isSearching: false,
            ctrlIsPressed: false,
        };
    },

    mounted() {
        this.dataset = Object.assign({}, this.toolbar, this.items);
    },

    setup() {
        const toolbar = useToolbarStore();
        return { toolbar };
    },
    methods: {
        emitRestoreButtonClicked() {
            this.$emit("update:restore");
        },
    },
};
</script>
<template>
    <div class="sticky sheet">
        <v-toolbar flat height="auto">
            <v-row align="center" justify="space-betwen">
                <v-col cols="12" sm="4">
                    <slot name="search">
                        <v-badge
                            v-model="items.isSearching"
                            :bordered="true"
                            bottom
                            class="dt-badge d-block"
                            color="dark"
                            content="/"
                            offset-x="28"
                            offset-y="28"
                            tile
                            transition="fade-transition"
                        >
                            <!--
                                //comment key events
                                v-shortkey="['ctrl', '/']"
                                @keydown.native="search"
                                @shortkey.native="focus"
                            -->
                            <v-text-field
                                ref="tablesearch"
                                v-model="items.search"
                                :prepend-inner-icon="
                                    items.isSearching
                                        ? 'mdi-spin mdi-loading'
                                        : 'mdi-magnify'
                                "
                                autocomplete="off"
                                background-color="workspace"
                                class="dt-text-field__search"
                                clear-icon="mdi-close-circle-outline"
                                clearable
                                filled
                                flat
                                full-width
                                hide-details
                                placeholder="Search..."
                                single-line
                                solo
                                @click:clear="search"
                            >
                            </v-text-field>
                        </v-badge>
                    </slot>
                </v-col>
                <v-col cols="12" sm="auto">
                    <div
                        class="d-flex justify-sm-space-between justify-end align-center"
                    >
                        <v-slide-x-reverse-transition>
                            <div v-if="items.bulkCount" class="px-2">
                                {{
                                    // $tc(
                                    ("{number} item selected",
                                    items.bulkCount,
                                    { number: items.bulkCount })
                                    // )
                                }}
                            </div>
                        </v-slide-x-reverse-transition>
                        <v-slide-x-reverse-transition>
                            <v-divider
                                v-if="items.bulkCount"
                                class="mx-2"
                                vertical
                            ></v-divider>
                        </v-slide-x-reverse-transition>
                        <v-spacer v-if="items.bulkCount"></v-spacer>

                        <!-- Action buttons -->
                        <v-scale-transition>
                            <span v-if="items.toggleBulkEdit">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="downloadable"
                                            :disabled="!items.toggleBulkEdit"
                                            class="mr-2"
                                            icon
                                            v-on="on"
                                        >
                                            <v-icon small>mdi-download</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>{{
                                        trans("Export selected items")
                                    }}</span>
                                </v-tooltip>
                            </span>
                        </v-scale-transition>
                        <v-scale-transition>
                            <span v-if="items.toggleBulkEdit">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="restorable"
                                            :disabled="!items.toggleBulkEdit"
                                            class="mr-2"
                                            icon
                                            @click="
                                                askUserToBulkRestoreResources
                                            "
                                            v-on="on"
                                        >
                                            <v-icon small>mdi-restore</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>{{
                                        trans("Restore selected items")
                                    }}</span>
                                </v-tooltip>
                            </span>
                        </v-scale-transition>
                        <v-scale-transition>
                            <span v-if="items.toggleBulkEdit">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="trashable"
                                            :disabled="!items.toggleBulkEdit"
                                            class="mr-2"
                                            icon
                                            @click="
                                                askUserToBulkDestroyResources
                                            "
                                            v-on="on"
                                        >
                                            <v-icon small
                                                >mdi-delete-outline</v-icon
                                            >
                                        </v-btn>
                                    </template>
                                    <span>{{
                                        trans("Move selected items to trash")
                                    }}</span>
                                </v-tooltip>
                            </span>
                        </v-scale-transition>
                        <v-scale-transition>
                            <span v-if="items.toggleBulkEdit">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-if="deletable"
                                            :disabled="!items.toggleBulkEdit"
                                            class="mr-2"
                                            icon
                                            @click="
                                                askUserToBulkPermanentlyDeleteResources
                                            "
                                            v-on="on"
                                        >
                                            <v-icon small
                                                >mdi-delete-forever-outline</v-icon
                                            >
                                        </v-btn>
                                    </template>
                                    <span>{{
                                        trans_choice(
                                            "Permanently delete the selected item",
                                        )
                                    }}</span>
                                </v-tooltip>
                            </span>
                        </v-scale-transition>
                        <!-- Action buttons -->

                        <v-badge
                            v-model="ctrlIsPressed"
                            bordered
                            bottom
                            class="dt-badge d-block"
                            color="dark"
                            content="shift+a"
                            offset-x="30"
                            offset-y="20"
                            tile
                            transition="fade-transition"
                        >
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn-toggle
                                        v-if="bulk"
                                        v-model="items.toggleBulkEdit"
                                        color="primary"
                                        dense
                                        rounded
                                    >
                                        <v-btn
                                            v-shortkey="['ctrl', 'shift', 'a']"
                                            :value="true"
                                            color="primary"
                                            icon
                                            @shortkey="
                                                items.toggleBulkEdit =
                                                    !items.toggleBulkEdit
                                            "
                                            v-on="on"
                                        >
                                            <v-icon
                                                v-if="items.toggleBulkEdit"
                                                color="primary"
                                                small
                                                >mdi-close
                                            </v-icon>
                                            <v-icon v-else small
                                                >mdi-check-box-multiple-outline
                                            </v-icon>
                                        </v-btn>
                                    </v-btn-toggle>
                                </template>
                                <span>{{
                                    trans("Toggle multiple selection")
                                }}</span>
                            </v-tooltip>
                        </v-badge>

                        <v-divider
                            v-if="dataset.verticaldiv"
                            vertical
                        ></v-divider>

                        <!-- list and grid view -->
                        <template v-if="dataset.listGridView">
                            <!-- grid -->
                            <template v-if="toolbar.toggleview">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            slot="activator"
                                            icon
                                            @click="toggleView"
                                        >
                                            <v-icon small
                                                >mdi-format-list-checkbox
                                            </v-icon>
                                        </v-btn>
                                        <span>{{
                                            trans("Switch to List View")
                                        }}</span>
                                    </template>
                                </v-tooltip>
                            </template>
                        </template>
                        <!-- list and grid view -->

                        <!-- filter -->
                        <slot name="filter"></slot>
                        <!-- filter -->
                    </div>
                </v-col>
            </v-row>
        </v-toolbar>
    </div>
</template>
