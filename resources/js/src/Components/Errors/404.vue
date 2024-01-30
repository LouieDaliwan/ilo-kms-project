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
                                class="primary--text"
                            ></open-map-icon>
                        </v-col>

                        <v-col class="order-md-1" cols="12" md="5">
                            <div class="text-center">
                                <h3 class="text-uppercase muted--text mb-5">
                                    <strong>404 Error</strong>
                                </h3>
                                <h2 class="mb-2">There's no page here 😭</h2>
                                <p class="muted--text mb-5">
                                    Looks like you ended up here by accident?
                                </p>

                                <v-btn
                                    :to="{ name: 'dashboard' }"
                                    class="mb-5"
                                    color="primary"
                                    exact
                                    large
                                    v-text="trans('Return to your dashboard')"
                                ></v-btn>

                                <!-- <superadmin-only></superadmin-only> -->
                            </div>
                        </v-col>
                    </v-row>
                </v-col>
            </v-container>
        </v-slide-y-transition>
    </v-app>
</template>
