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
                        </v-card-text>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </section>
</template>
