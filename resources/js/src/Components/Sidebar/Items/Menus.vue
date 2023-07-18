<template>
  <!-- Menu -->
  <!-- Menu Items -->
  <v-list nav dark class="secondary workspace-x py-6">
    <template v-for="(parent, i) in menus">
      <!-- Menu with children -->
      <template v-if="parent.meta.divider">
        <v-divider :key="i" class="my-2"></v-divider>
      </template>
      <template v-else-if="parent.meta.subheader">
        <v-list-subheader class="text--muted text-capitalize" :key="i">{{
          parent.meta.title
        }}</v-list-subheader>
      </template>
      <template v-else-if="parent.children">
        <!-- <can
            :code="parent.meta.permission"
            :viewable="parent.meta['viewable:superadmins']"
          > -->
        <v-list-group :key="i" no-action :value="active(parent)" color="black">
          <template v-slot:activator>
            <v-list-item>
              <v-list-item-title class="font-weight-bold">{{
                parent.meta.title
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
                  color="black"
                >
                  <!-- <v-icon v-if="submenu.meta.icon"> -->
                  <!-- <v-icon small icon="submenu.meta.icon"></v-icon> -->
                  <!-- </v-icon> -->
                  <v-list-item>
                    <v-list-item-title class="font-weight-bold white--text"
                      >{{ submenu.meta.title }}
                    </v-list-item-title>
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
          <v-icon small :icon="parent.meta.icon"></v-icon>
          <v-list-item>
            <v-list-item-title
              :title="parent.meta.title"
              class="font-weight-bold"
            ></v-list-item-title>
          </v-list-item>
        </v-list-item>
        <!-- </can> -->
      </template>
      <!-- Menu without Children -->
    </template>

    <!-- FAQ -->
    <template>
      <!-- <can code=""> -->
      <v-list-item color="black">
        <!-- <v-list-item-icon> -->
        <!-- <v-icon
                small
                v-text="__('mdi-frequently-asked-questions')"
                ></v-icon> -->
        <!-- </v-list-item-icon> -->
        <v-list-item>
          <v-list-item-title :title="'FAQs'" class="font-weight-bold"></v-list-item-title>
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
      console.log;
      console.log(this.$route.name);
      console.log(window._.includes(path.meta.children, this.$route.name));
      return window._.includes(path.meta.children, this.$route.name);
    },
  },

  mounted() {
    console.log(menus);
  },
};
</script>
