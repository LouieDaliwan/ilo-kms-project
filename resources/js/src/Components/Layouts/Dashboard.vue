<script>
import Header from "./Header.vue"
import Footer from "./Footer.vue"
export default {
    name: "Blank",
};
</script>

<template>
    <v-app
        v-cloak
        id="app"
        class="dovetail-app v-application--is-ltr theme--light v-application"
    >
        <Header />
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
        <Footer />
        <auth-logout></auth-logout>
        <!--        <dialog-box></dialog-box>-->
    </v-app>
</template>
