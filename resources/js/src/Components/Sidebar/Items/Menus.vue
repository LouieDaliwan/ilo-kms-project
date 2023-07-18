<template>
  <v-list nav dark class="secondary workspace-x py-6">
    <template v-for="(parent, i) in menus">
      <!-- Menu with children -->
      <template v-if="parent.meta.divider">
        <v-divider :key="i" class="my-2"></v-divider>
      </template>
      <template v-else-if="parent.meta.subheader">
        <v-list-subheader
          class="text--muted text-capitalize"
          :key="i"
          :title="$t(parent.meta.title)"
        ></v-list-subheader>
      </template>
      <template v-else-if="parent.children">
        <!-- <can
            :code="parent.meta.permission"
            :viewable="parent.meta['viewable:superadmins']"
          > -->
        <v-list-group
          :key="i"
          no-action
          :prepend-icon="parent.meta.icon"
          :value="active(parent)"
          color="white"
        >
          <template v-slot:activator>
            <v-list-item>
              <v-list-item-title class="font-weight-bold">{{
                $t(parent.meta.title)
              }}</v-list-item-title>
            </v-list-item>
          </template>
          <!-- Submenu children -->
          <template v-for="(submenu, j) in parent.children">
            <v-divider v-if="submenu.meta.divider" :key="i"></v-divider>
            <template v-else>
              <template v-if="submenu.children"></template>
              <template v-else-if="submenu.meta.divider">
                <v-divider :key="i"></v-divider>
              </template>
              <template v-else>
                <!-- <can
                      :code="submenu.meta.permission"
                      :viewable="submenu.meta['viewable:superadmins']"
                    > -->
                <v-list-item
                  :key="j"
                  :target="submenu.meta.external ? '_blank' : null"
                  :to="{ name: submenu.name }"
                  :exact="inactive(submenu)"
                  color="white"
                >
                  <v-list-img v-if="submenu.meta.icon">
                    <v-icon small :icon="submenu.meta.icon"></v-icon>
                  </v-list-img>
                  <v-list-item>
                    <v-list-item-title class="font-weight-bold white--text">{{
                      $t(submenu.meta.title)
                    }}</v-list-item-title>
                  </v-list-item>
                </v-list-item>
                <!-- </can> -->
              </template>
            </template>
          </template>
        </v-list-group>
        <!-- </can> -->
      </template>
      <!-- Menu with Children -->
      <!-- Menu without Children -->
      <template v-else>
        <!-- <can
            :code="parent.meta.permission"
            :viewable="parent.meta['viewable:superadmins']"
          > -->
        <v-list-item color="white" :key="i" link exact :to="{ name: parent.name }">
          <v-list-img>
            <v-icon small :icon="parent.meta.icon"></v-icon>
          </v-list-img>
          <v-list-item>
            <v-list-item-title class="font-weight-bold">
              {{ $t(parent.meta.title) }}
            </v-list-item-title>
          </v-list-item>
        </v-list-item>
        <!-- </can> -->
      </template>
      <!-- Menu without Children -->
    </template>

    <!-- FAQ -->
    <template>
      <!-- <can code=""> -->
      <v-list-item color="white" link exact :to="{ name: 'members.index' }">
        <v-list-img>
          <v-icon small :icon="'mdi-frequently-asked-questions'"></v-icon>
        </v-list-img>
        <v-list-item>
          <v-list-item-title class="font-weight-bold">{{ $t("FAQs") }}</v-list-item-title>
        </v-list-item>
      </v-list-item>
      <!-- </can> -->
    </template>
    <!-- FAQ -->
  </v-list>
</template>

<script>
import menus from "@/config/sidebar";
export default {
  name: "Menus",

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
