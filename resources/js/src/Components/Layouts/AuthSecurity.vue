<template>
    <div>
        <v-slide-y-transition mode="out-in">
            <appbar>
                <slot name="appbar"></slot>
            </appbar>
        </v-slide-y-transition>

        <v-main style="min-height: 100vh">
            <div class="mb-12">
                <v-container>
                    <slot>
                        <router-view v-slot="{ Component, route }">
                            <v-slide-y-reverse-transition mode="out-in">
                                <template #default>
                                    <component
                                        :is="Component"
                                        :key="
                                            route.meta.title
                                                ? route.path
                                                : undefined
                                        "
                                    ></component>
                                </template>
                            </v-slide-y-reverse-transition>
                        </router-view>
                    </slot>
                </v-container>
            </div>
            <!-- <v-footer absolute paddless color="workspace">
      <shortkey></shortkey>
      <v-container>
      <breadcrumbs></breadcrumbs>
      </v-container>
  </v-footer> -->
        </v-main>
    </div>
</template>

<script>
import Appbar from "@/Components/Appbar/AppbarTwo.vue";

export default {
    components: {
        Appbar,
    },
};
</script>
