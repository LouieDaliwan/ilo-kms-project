<template>
    <v-app v-cloak footer toolbar>
        <!-- Main Content -->

        <v-main>
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
        </v-main>
        <!-- Main Content -->

        <!-- <progressbar></progressbar> -->
    </v-app>
</template>

<script>
export default {
    name: "Auth",
};
</script>
