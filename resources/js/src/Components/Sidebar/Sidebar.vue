<template>
  <v-navigation-drawer
    :clipped="true"
    app
    fixed
    v-model="sidebarModel"
    class="dt-sidebar secondary workspace-x"
  >
    <brand></brand>

    <menus></menus>

    <!-- Sidebar Footer -->
    <template v-slot:append>
      <!-- <div class="ma-4"> -->
      <!-- <language-button></language-button> -->
      <!-- </div> -->
      <div class="px-4 py-2 d-flex justify-space-between align-center">
        <div class="white--text">
          <small>
            <div>Powered by</div>
            <div>Louie Daliwan &copy; 2023</div>
          </small>
        </div>
        <!-- <v-btn icon @click="$store.dispatch('theme/toggle', {vm: vuetify, dark: !dark})"> -->
        <!-- <v-btn
                icon
                @click="$store.dispatch('theme/toggle', { vm: vuetify, dark: !dark })"
                >
                <v-icon color="white">mdi-invert-colors</v-icon>
                </v-btn> -->
        <!-- <theme-changer></theme-changer> -->
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
import app from "@/config/app";
import Brand from "./Items/Brand.vue";
import Menus from "./Items/Menus.vue";
export default {
  name: "Sidebar",
  components: {
    Brand,
    Menus
  },
  data() {
    return {
      sidebarModel: "",
    };
  },

  computed: {
    app() {
      return app;
    },
  },
};
</script>
