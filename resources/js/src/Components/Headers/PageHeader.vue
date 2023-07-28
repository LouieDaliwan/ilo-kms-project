<script>
import { useDisplay } from "vuetify";
import { ref } from "vue";
import page from "@/mixins/page.js";

export default {
    name: "PageHeader",
    computed: {
        page() {
            return page;
        },
    },
    props: {
        back: Object,
    },

    setup() {
        const display = ref(useDisplay());
        return { display };
    },
};
</script>
<template>
    <v-row class="mb-4">
        <v-col cols="12">
            <div class="d-block d-sm-flex justify-space-between align-center">
                <div>
                    <slot :back="back" name="back">
                        <template v-if="$route.query.from">
                            <div class="mb-2">
                                <router-link
                                    :to="$route.query.from"
                                    class="text--decoration-none body-1 dt-link"
                                    exact
                                    tag="a"
                                >
                                    <v-icon class="mb-1" small
                                        >mdi mdi-chevron-left
                                    </v-icon>
                                    <span v-text="trans('Back')"></span>
                                </router-link>
                            </div>
                        </template>
                        <template v-else>
                            <div v-if="back" class="mb-2">
                                <router-link
                                    :to="back.to"
                                    class="text--decoration-none body-1 dt-link"
                                    exact
                                    tag="a"
                                >
                                    <v-icon class="mb-1" small
                                        >mdi mdi-chevron-left
                                    </v-icon>
                                    <span v-text="back.text"></span>
                                </router-link>
                            </div>
                        </template>
                    </slot>

                    <h2
                        :title="page.title"
                        class="d.sm-nd-up ? '' : 'title font-weight-bold' mb-1"
                    >
                        <slot name="title">
                            {{ page.title }}
                        </slot>
                    </h2>
                    <slot name="utilities"></slot>
                </div>
                <div class="mt-sm-0 mt-3">
                    <slot name="action"></slot>
                </div>
            </div>
        </v-col>
    </v-row>
</template>
