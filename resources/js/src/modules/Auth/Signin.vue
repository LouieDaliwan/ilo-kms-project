<script setup>
import LoginForm from "./cards/LoginForm.vue";
import { useDisplay } from "vuetify";

const { smAndDown } = useDisplay();
</script>

<template>
    <section>
        <v-row align="center" justify="center">
            <v-col :pa-5="!!smAndDown" cols="12" md="6">
                <v-row align="center" justify="center">
                    <v-col cols="12" md="7">
                        <v-card-text>
                            <div class="text-center">
                                <login-brand></login-brand>
                            </div>

                            <v-fade-transition mode="out-in">
                                <login-form></login-form>
                            </v-fade-transition>
                            <!-- divider -->
                            <div class="d-flex">
                                <v-divider class="my-9"></v-divider>
                                <span class="mt-6 px-3 link--text">Or</span>
                                <v-divider class="my-9"></v-divider>
                            </div>
                            <!-- divider -->
                        </v-card-text>
                         <!-- Social Log in -->
                        <div class="text-center">
                        <h4 class="mb-5">Log In with Another Account:</h4>
                        <div>
                            <v-btn x-large class="mr-4">
                            <img
                                height="20"
                                :src="'/images/google_logo.svg'"
                                alt=""
                            />
                            </v-btn>

                            <v-btn x-large class="mr-4">
                            <img
                                height="20"
                                :src="'/images/facebook_logo.svg'"
                                alt=""
                            />
                            </v-btn>
                        </div>
                        </div>
                        <p class="text-center muted--text mt-5">
                        <small>
                            By logging in, you agree to our
                            <a href="javascript:void(0)"
                            >Privacy Policy</a
                            ></small
                        >
                        </p>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </section>
</template>
