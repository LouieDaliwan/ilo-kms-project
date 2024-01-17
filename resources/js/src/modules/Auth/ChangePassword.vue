<script setup>
import { useDisplay } from "vuetify";
import { computed, ref } from "vue";
import { useForm } from "vee-validate";
import { changePasswordValidation } from "./Schema/changePasswordValidation.js";
import { useRouter } from "vue-router";
import $api from "./routes/api.js";
import Swal from "sweetalert2";

const auth = ref({
    current_password: "",
    password: "",
    password_confirmation: "",
});

// const btnDisable = ref({
//     isDisable: true
// })
const isDisable = ref(true)


const loading = ref(false);
const showPassword = ref(false);
const newPassword = ref(false);
const confirmPassword = ref(false);
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
            Swal.fire({
            title: "Success!",
            text: "You have successfully changed your password.",
            icon: "success",
            confirmButtonColor:"#1E2DBE"
            });
        });
});

const onInput = () => {
        // btnDisable.isDisable.value = false;
        isDisable.value = false;
        console.log(isDisable)
}
</script>

<template>
    <section class="change-pass mt-5">
        <v-row>
            <v-col cols="12" md="12">
                <v-card class="mb-3">
                    <v-card-title class="mb-5">Change Password</v-card-title>
                    <v-card-text>
                            <v-form :disabled="loading" @submit.prevent="onSubmit" @input="onInput">
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
                                    :append-icon="newPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    prepend-inner-icon="mdi-lock-outline"
                                    :type="newPassword ? 'text' : 'password'"
                                    class="mb-3"
                                    clear-icon="mdi mdi-close-circle-outline"
                                    clearable
                                    label="New Password"
                                    outlined
                                    password
                                    v-bind="password"
                                    @click:append="newPassword = !newPassword"
                                ></v-text-field>

                                <v-text-field
                                    v-model="auth.password_confirmation"
                                    :append-icon="confirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    prepend-inner-icon="mdi-lock-outline"
                                    :type="confirmPassword ? 'text' : 'password'"
                                    class="mb-3"
                                    clear-icon="mdi mdi-close-circle-outline"
                                    clearable
                                    label="Confirm New Password"
                                    outlined
                                    password
                                    v-bind="password_confirmation"
                                    @click:append="confirmPassword = !confirmPassword"
                                ></v-text-field>

                                <v-divider class="my-4"></v-divider>

                                    <!-- :disabled="loading" -->
                                <v-btn
                                    :loading="loading"
                                    :disabled="isDisable"
                                    block
                                    color="primary"
                                    type="submit"
                                    x-large
                                >
                                    Update
                                    <template v-slot:loader>
                                        <v-slide-x-transition>
                                            <v-icon class="mdi-spin mr-3" dark>mdi-loading</v-icon>
                                        </v-slide-x-transition>
                                        <span>Updating...</span>
                                    </template>
                                </v-btn>
                            </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </section>
</template>
