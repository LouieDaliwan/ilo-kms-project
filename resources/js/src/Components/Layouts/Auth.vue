<template>
    <v-app v-cloak footer toolbar>
        <!-- Main Content -->

        <v-main>
            <!-- Preloader -->
            <!-- <preloader></preloader> -->
            <!-- Preloader -->

            <!-- Main -->
            <v-slide-y-transition mode="out-in">
                <router-view></router-view>
            </v-slide-y-transition>
            <!-- Main -->
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
