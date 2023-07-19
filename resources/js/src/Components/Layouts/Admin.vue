<template>
  <div>
    <v-slide-y-transition>
      <app-bar>
        <slot name="appbar"></slot>
      </app-bar>
    </v-slide-y-transition>

    <v-content style="min-height: 100vh">
      <div class="mb-12">
        <v-container>
          <slot>
            <v-slide-y-reverse-transition mode="out-in">
              <router-view></router-view>
            </v-slide-y-reverse-transition>
          </slot>
        </v-container>
      </div>
      <!-- <v-footer absolute paddless color="workspace">
        <shortkey></shortkey>
        <v-container>
          <breadcrumbs></breadcrumbs>
        </v-container>
      </v-footer> -->
    </v-content>
  </div>
</template>

<script>
import Appbar from "@/Components/Appbar/Appbar.vue";
export default {
  components: {
    Appbar,
  },
};
</script>
