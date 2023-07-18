<template>
  <v-layout class="rounded dovetail-app" v-cloak>
    <v-app title="Application bar"></v-app>
    <sidebar></sidebar>

    <router-view>
      <v-slide-y-transition
        mode="out-in"
        class="d-flex align-center justify-center"
        style="min-height: 300px"
      >
      </v-slide-y-transition>
    </router-view>

    <!-- <v-main >
      Main Content
    </v-main> -->
  </v-layout>
</template>

<script>
import Sidebar from "@components/Sidebar/Sidebar.vue";

export default {
  name: "Blank",
  components: {
    Sidebar,
  },
};

Sidebar;
</script>
