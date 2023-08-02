<template>
    <v-card class="mb-3">
        <v-card-title>Metainfo</v-card-title>
        <v-list dense disabled>
            <v-list-group color="primary">
                <v-list-item>
                    <v-list-img>
                        <v-icon small v-text="'mdi-calendar'"></v-icon>
                    </v-list-img>
                    <v-list-item-title>
                        <v-skeleton-loader type="text"></v-skeleton-loader>
                    </v-list-item-title>
                </v-list-item>

                <v-list-item>
                    <v-list-img>
                        <v-icon small v-text="'mdi-calendar-edit'"></v-icon>
                    </v-list-img>
                    <v-list-item-title>
                        <v-skeleton-loader type="text"></v-skeleton-loader>
                    </v-list-item-title>
                </v-list-item>
            </v-list-group>
        </v-list>
    </v-card>
</template>
