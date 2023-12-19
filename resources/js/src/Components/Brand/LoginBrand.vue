<template>
    <section class="text-center mb-5 mt-5">
        <v-row align="center" justify="center">
            <v-img
                :lazy-src="app.logo"
                :max-width="brand"
                :src="app.logo"
                class="mb-3"
            ></v-img>
        </v-row>
        <h1>Log in to {{ app.title }}</h1>
        <!-- <h3 class="my-6" v-text="app.title"></h3> -->
        <!-- <p class="muted--text" v-text="app.tagline"></p> -->
    </section>
</template>

<script>
import app from "@/config/app";

export default {
    data: () => ({
        app,
        brand: 240,
    }),
};
</script>
