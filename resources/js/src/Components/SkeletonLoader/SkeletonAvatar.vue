<template>
    <v-card class="mb-3">
        <v-card-title class="pb-0">Photo</v-card-title>
        <v-card-text class="text-center">
            <div class="d-flex justify-center">
                <v-skeleton-loader
                    class="dt-skeleton-avatar-upload"
                    type="avatar"
                ></v-skeleton-loader>
            </div>
        </v-card-text>
    </v-card>
</template>

<style>
.dt-skeleton-avatar-upload .v-skeleton-loader__avatar {
    height: 160px;
    width: 160px;
}
</style>
