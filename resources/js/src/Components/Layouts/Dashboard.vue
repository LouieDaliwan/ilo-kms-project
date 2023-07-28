<template>
    <v-layout
        v-cloak
        id="app"
        class="dovetail-app v-application--is-ltr theme--light v-application"
    >
        <sidebar></sidebar>

        <router-view v-slot="{ Component, route }">
            <v-slide-y-reverse-transition
                class="d-flex align-center justify-center"
                mode="out-in"
                style="min-height: 300px"
            >
                <template #default>
                    <component
                        :is="Component"
                        :key="route.meta.title ? route.path : undefined"
                    ></component>
                </template>
            </v-slide-y-reverse-transition>
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
