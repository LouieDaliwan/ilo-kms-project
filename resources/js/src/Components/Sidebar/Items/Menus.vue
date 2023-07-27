<template>
    <v-list
        v-model:opened="open"
        class="secondary workspace-x py-6"
        dark
        nav
        @update:opened="open = $event.slice(-1)"
    >
        <template v-for="(parent, i) in menus">
            <template v-if="parent.meta.divider">
                <v-divider :key="i" class="my-2"></v-divider>
            </template>

            <template v-else-if="parent.meta.subheader">
                <v-list-subheader :key="i" class="text--muted text-capitalize">
                    {{ parent.meta.title }}
                </v-list-subheader>
            </template>

            <template v-else-if="parent.children">
                <v-list-group
                    :key="i"
                    :prepend-icon="parent.meta.icon"
                    :value="active(parent)"
                    color="white"
                    no-action
                >
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            :title="parent.meta.title"
                            v-bind="props"
                        ></v-list-item>
                    </template>

                    <template v-for="(submenu, j) in parent.children">
                        <v-divider
                            v-if="submenu.meta.divider"
                            :key="i"
                        ></v-divider>
                        <template v-else>
                            <template v-if="submenu.children"></template>
                            <template v-else-if="submenu.meta.divider">
                                <v-divider :key="i"></v-divider>
                            </template>

                            <template v-else>
                                <v-list-item
                                    :key="j"
                                    :exact="inactive(submenu)"
                                    :prepend-icon="submenu.meta.icon"
                                    :target="
                                        submenu.meta.external ? '_blank' : null
                                    "
                                    :title="submenu.meta.title"
                                    :to="{ name: submenu.name }"
                                    :value="submenu.meta.title"
                                    class="font-weight-bold white--text"
                                    color="white"
                                ></v-list-item>
                            </template>
                        </template>
                    </template>
                </v-list-group>
            </template>

            <template v-else>
                <v-list-item
                    :key="i"
                    :prepend-icon="parent.meta.icon"
                    :title="parent.meta.title"
                    :to="{ name: parent.name }"
                    class="font-weight-bold white--text"
                    color="white"
                ></v-list-item>
            </template>
        </template>

        <!-- FAQ -->
        <!-- <template> -->
        <!-- <can code=""> -->
        <!-- <v-list-item color="white" link exact :to="{ name: 'members.index' }">
            <v-list-img>
              <v-icon size="small" :icon="'mdi-frequently-asked-questions'"></v-icon>
            </v-list-img>
            <v-list-item>
              <v-list-item-title class="font-weight-bold">FAQs</v-list-item-title>
            </v-list-item>
          </v-list-item> -->
        <!-- </can> -->
        <!-- </template> -->
        <!-- FAQ -->
    </v-list>
</template>

<script>
import { ref } from "vue";
import menus from "@/config/sidebar";

export default {
    name: "Menus",

    data() {
        return {
            open: ref([]),
        };
    },

    computed: {
        menus() {
            return menus;
        },
    },

    methods: {
        inactive(path) {
            return !this.active(path);
        },

        active(path) {
            return path.meta.title;
        },
    },
};
</script>
