<script setup>
import { useDisplay } from "vuetify";
import { computed, ref } from "vue";
import { useForm } from "vee-validate";
import { loginSchema } from "../Schema/loginvalidation.js";
import { useRouter } from "vue-router";

const auth = ref({
    email: "",
    password: "",
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

const email = defineComponentBinds("email", vuetifyConfig);
const password = defineComponentBinds("password", vuetifyConfig);

const onSubmit = handleSubmit((values) => {
    const { email, password } = auth.value;

    load();

    axios.get("/sanctum/csrf-cookie ").then((response) => {
        axios
            .post("/login", { email, password })
            .then(({ data }) => {
                const isTemporaryPassword = data.auth.is_temporary_password;
                localStorage.setItem(
                    "isTemporaryPassword",
                    isTemporaryPassword,
                );
                localStorage.setItem("auth", Object.entries(data.auth));
                localStorage.setItem("two_factor", data.two_factor);
                localStorage.setItem("auth_token", data.token);

                let queryParam =
                    isTemporaryPassword === "true"
                        ? "change-password"
                        : "dashboard";

                router.push({ name: queryParam });
            })
            .catch((err) => {
                if (err.response.status !== 422) return;
                setErrors(err.response.data.errors);
            })
            .finally(() => {
                load(false);
            });
    });
});
</script>

<template>
    <v-form :disabled="loading" @submit.prevent="onSubmit">
        <v-text-field
            v-model="auth.email"
            autofocus
            class="mb-3 login-email"
            clear-icon="mdi mdi-close-circle-outline"
            clearable
            label="Email or Username"
            outlined
            v-bind="email"
        ></v-text-field>
        <v-text-field
            v-model="auth.password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'text' : 'password'"
            class="mb-3 login-pass"
            clear-icon="mdi mdi-close-circle-outline"
            clearable
            label="Password"
            outlined
            password
            v-bind="password"
            @click:append="showPassword = !showPassword"
        ></v-text-field>

        <!-- Forgot Password -->
        <a class="text-decoration-none" href="javascript:void(0)">
            <div class="text-end my-4 mb-3">I forgot my password</div>
        </a>
        <!-- Forgot Password -->
        <v-btn
            :disabled="loading"
            :loading="loading"
            block
            color="primary"
            type="submit"
            x-large
        >
            Log In
            <template v-slot:loader>
                <v-slide-x-transition>
                    <v-icon class="mdi-spin mr-3" dark>mdi-loading</v-icon>
                </v-slide-x-transition>
                <span>Signing in...</span>
            </template>
        </v-btn>
    </v-form>
</template>
