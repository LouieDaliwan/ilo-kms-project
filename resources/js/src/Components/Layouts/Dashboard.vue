<template>
  <v-layout
    class="dovetail-app v-application--is-ltr theme--light v-application"
    id="app"
    v-cloak
  >
    <sidebar></sidebar>

    <v-slide-y-transition
      mode="out-in"
      class="d-flex align-center justify-center"
      style="min-height: 300px"
    >
      <router-view></router-view>
    </v-slide-y-transition>
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
