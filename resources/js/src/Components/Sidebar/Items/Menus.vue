<template>
  <v-list
    v-model:opened="open"
    @update:opened="open = $event.slice(-1)"
    nav
    dark
    class="secondary workspace-x py-6"
  >
    <template v-for="(parent, i) in menus">
      <template v-if="parent.meta.divider">
        <v-divider :key="i" class="my-2"></v-divider>
      </template>

      <template v-else-if="parent.meta.subheader">
        <v-list-subheader class="text--muted text-capitalize" :key="i">
          {{ parent.meta.title }}
        </v-list-subheader>
      </template>

      <template v-else-if="parent.children">
        <v-list-group
          :key="i"
          no-action
          :prepend-icon="parent.meta.icon"
          :value="active(parent)"
          color="white"
        >
          <template v-slot:activator="{ props }">
            <v-list-item v-bind="props" :title="parent.meta.title"></v-list-item>
          </template>

          <template v-for="(submenu, j) in parent.children">
            <v-divider v-if="submenu.meta.divider" :key="i"></v-divider>
            <template v-else>
              <template v-if="submenu.children"></template>
              <template v-else-if="submenu.meta.divider">
                <v-divider :key="i"></v-divider>
              </template>

              <template v-else>
                <v-list-item
                  :key="j"
                  :target="submenu.meta.external ? '_blank' : null"
                  :to="{ name: submenu.name }"
                  :exact="inactive(submenu)"
                  color="white"
                  :title="submenu.meta.title"
                  :prepend-icon="submenu.meta.icon"
                  :value="submenu.meta.title"
                  class="font-weight-bold white--text"
                ></v-list-item>
              </template>
            </template>
          </template>
        </v-list-group>
      </template>

      <template v-else>
        <v-list-item
          :key="i"
          :to="{ name: parent.name }"
          exact
          link
          color="white"
          :title="parent.meta.title"
          :prepend-icon="parent.meta.icon"
          class="font-weight-bold white--text"
        ></v-list-item>
      </template>
    </template>

    <!-- FAQ -->
    <template>
      <!-- <can code=""> -->
      <v-list-item color="white" link exact :to="{ name: 'members.index' }">
        <v-list-img>
          <v-icon size="small" :icon="'mdi-frequently-asked-questions'"></v-icon>
        </v-list-img>
        <v-list-item>
          <v-list-item-title class="font-weight-bold">FAQs</v-list-item-title>
        </v-list-item>
      </v-list-item>
      <!-- </can> -->
    </template>
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
      return window._.includes(path.meta.children, this.$route.name);
    },
  },
};
</script>
