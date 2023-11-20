<script setup>
import { useDisplay } from "vuetify";
import { computed, ref } from "vue";
import { useForm } from "vee-validate";
import { loginSchema } from "./Schema/loginvalidation.js";
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
    validationSchema: loginSchema,
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
const confirm_password = defineComponentBinds(
    "confirm_password",
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
            const isTemporaryPassword = localStorage.setItem(
                "isTemporaryPassword",
                data.auth.is_temporary_password,
            );
            localStorage.setItem("auth", Object.entries(data.auth));
            localStorage.setItem("two_factor", data.two_factor);

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
    <auth-security>
        <v-form :disabled="loading" @submit.prevent="onSubmit">
            <v-text-field
                v-model="auth.current_password"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
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
                :type="showPassword ? 'text' : 'password'"
                class="mb-3"
                clear-icon="mdi mdi-close-circle-outline"
                clearable
                label="Password"
                outlined
                password
                v-bind="password"
                @click:append="showPassword = !showPassword"
            ></v-text-field>

            <v-text-field
                v-model="auth.password_confirmation"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showPassword ? 'text' : 'password'"
                class="mb-3"
                clear-icon="mdi mdi-close-circle-outline"
                clearable
                label="Confirm Password"
                outlined
                password
                v-bind="confirm_password"
                @click:append="showPassword = !showPassword"
            ></v-text-field>

            <v-divider class="my-4"></v-divider>

            <v-btn
                :disabled="loading"
                :loading="loading"
                block
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
    </auth-security>
</template>
