<script setup>
import { useDisplay } from "vuetify";
import { computed, ref } from "vue";
import { useForm } from "vee-validate";
import { changePasswordValidation } from "./Schema/changePasswordValidation.js";
import { useRouter } from "vue-router";
import $api from "./routes/api.js";

const auth = ref({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const loading = ref(false);
const showPassword = ref(false);
const { smAndDown } = useDisplay();
const router = useRouter();

const load = (state = true) => {
    loading.value = state;
};

const isMobile = computed({
    get: () => !!smAndDown,
    set: (val) => !!smAndDown,
});

const { defineComponentBinds, handleSubmit, resetForm, setErrors } = useForm({
    validationSchema: changePasswordValidation,
});

const vuetifyConfig = (state) => ({
    props: {
        "error-messages": state.errors,
    },
});

const password = defineComponentBinds("password", vuetifyConfig);
const current_password = defineComponentBinds(
    "current_password",
    vuetifyConfig,
);
const password_confirmation = defineComponentBinds(
    "password_confirmation",
    vuetifyConfig,
);

const onSubmit = handleSubmit((values) => {
    const { current_password, password, password_confirmation } = auth.value;

    load();

    axios
        .put($api.updatePassword(), {
            current_password,
            password,
            password_confirmation,
        })
        .then(({ data }) => {
            localStorage.setItem("isTemporaryPassword", "false");
            router.push({ name: "dashboard" });
        })
        .catch((err) => {
            setErrors(err.response.data.errors);
        })
        .finally(() => {
            load(false);
        });
});
</script>

<template>
    <section class="change-pass">
    <v-row align="center" justify="center">
        <v-col :pa-5="!!smAndDown" cols="12" md="6">
            <v-row align="center" justify="center">
                <v-col cols="12" md="7">
                    <v-card-text>
                        <auth-security>
                            <v-form :disabled="loading" @submit.prevent="onSubmit">
                                <v-text-field
                                    v-model="auth.current_password"
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    prepend-inner-icon="mdi-shield-lock"
                                    :type="showPassword ? 'text' : 'password'"
                                    class="mb-3"
                                    clear-icon="mdi mdi-close-circle-outline"
                                    clearable
                                    label="Current Password"
                                    outlined
                                    password
                                    v-bind="current_password"
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>

                                <v-text-field
                                    v-model="auth.password"
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    prepend-inner-icon="mdi-lock-outline"
                                    :type="showPassword ? 'text' : 'password'"
                                    class="mb-3"
                                    clear-icon="mdi mdi-close-circle-outline"
                                    clearable
                                    label="New Password"
                                    outlined
                                    password
                                    v-bind="password"
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>

                                <v-text-field
                                    v-model="auth.password_confirmation"
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    prepend-inner-icon="mdi-lock-outline"
                                    :type="showPassword ? 'text' : 'password'"
                                    class="mb-3"
                                    clear-icon="mdi mdi-close-circle-outline"
                                    clearable
                                    label="Confirm New Password"
                                    outlined
                                    password
                                    v-bind="password_confirmation"
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>

                                <!-- <v-divider class="my-4"></v-divider> -->
                                <div class="text-end">
                                    <v-btn
                                        :disabled="loading"
                                        :loading="loading"
                                        color="primary"
                                        type="submit"
                                        x-large
                                    >
                                        <v-icon left>mdi-content-save-outline</v-icon>
                                        Update
                                        <template v-slot:loader>
                                            <v-slide-x-transition>
                                                <v-icon class="mdi-spin mr-3" dark>mdi-loading</v-icon>
                                            </v-slide-x-transition>
                                            <span>Updating...</span>
                                        </template>
                                    </v-btn>
                                </div>
                            </v-form>
                        </auth-security>
                        </v-card-text>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </section>
</template>
