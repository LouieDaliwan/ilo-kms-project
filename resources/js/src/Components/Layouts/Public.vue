<script setup></script>

<template>
    <v-app v-cloak class="dovetail-app" footer toolbar>
        <!-- Main Content -->
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
        <!-- Main Content -->
    </v-app>
</template>
