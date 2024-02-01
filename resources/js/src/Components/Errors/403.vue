<template>
    <v-app v-cloak class="dovetail-app" footer toolbar>
        <v-slide-y-transition mode="out-in">
            <v-container fill-height>
                <v-col cols="12">
                    <v-row align="center" justify="center">
                        <v-col
                            class="d-none d-md-flex order-md-2"
                            cols="12"
                            md="6"
                            offset-md="1"
                        >
                            <open-map-icon
                                class="text-primary"
                            ></open-map-icon>
                        </v-col>
                        <v-col class="text-center" cols="12" md="5">
                            <h1 class="display-4 text-muted mb-5">403</h1>
                            <h2 class="mb-3">Oops.. page is restricted.</h2>
                            <p class="text-muted mb-5">
                                We are sorry but you do not have permission to
                                access this page
                            </p>

                            <v-btn
                                :to="{ name: 'dashboard' }"
                                color="primary"
                                exact
                                large
                                v-text="'Return to your dashboard'"
                            ></v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-container>
        </v-slide-y-transition>
    </v-app>
</template>
