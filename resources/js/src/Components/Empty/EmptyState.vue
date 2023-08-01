<template>
    <v-row align="center" justify="center">
        <v-card class="text-center muted--text" color="transparent" flat>
            <div class="icon--disabled">
                <empty-icon class="primary--text"></empty-icon>
            </div>
            <h3 class="muted--text">{{ trans("No resource found") }}</h3>
            <p class="muted--text mb-8">"This page returned empty results."</p>
            <slot name="actions"></slot>
        </v-card>
    </v-row>
</template>

<style scoped>
.icon--disabled {
    filter: grayscale(0.8);
}
</style>
