<template>
    <validation-observer ref="signin-form" v-slot="{ passes }">
        <v-form :disabled="loading" v-on:submit.prevent="submit">
            <validation-provider
                v-slot="{ errors }"
                name="username"
                rules="required"
            >
                <v-text-field
                    v-model="auth.username"
                    :error-messages="errors"
                    :label="$t('Username')"
                    autofocus
                    class="mb-3"
                    clear-icon="mdi mdi-close-circle-outline"
                    clearable
                    outlined
                ></v-text-field>
            </validation-provider>

            <validation-provider
                v-slot="{ errors }"
                name="password"
                rules="required"
            >
                <v-text-field
                    v-model="auth.password"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :error-messages="errors"
                    :label="$t('Password')"
                    :type="showPassword ? 'text' : 'password'"
                    class="mb-3"
                    clear-icon="mdi mdi-close-circle-outline"
                    clearable
                    outlined
                    password
                    @click:append="showPassword = !showPassword"
                ></v-text-field>
            </validation-provider>

            <v-divider class="my-4"></v-divider>

            <v-btn
                :disabled="loading"
                :loading="loading"
                block
                type="submit"
                x-large
            >
                {{ $t("Sign In") }}
                <template v-slot:loader>
                    <v-slide-x-transition>
                        <v-icon class="mdi-spin mr-3" dark>mdi-loading </v-icon>
                    </v-slide-x-transition>
                    <span>{{ $t("Signing in...") }}</span>
                </template>
            </v-btn>
        </v-form>
    </validation-observer>
</template>

<script>
import $auth from "@/core/Auth/auth";

export default {
    name: "Login",

    data: () => ({
        auth: {
            username: "",
            password: "",
        },
        loading: false,
        showPassword: false,
    }),

    computed: {
        isMobile: function () {
            return this.$vuetify.breakpoint.smAndDown;
        },
    },

    methods: {
        load(val = true) {
            this.loading = val;
        },

        submit(e) {
            const { username, password } = this.auth;

            this.load();
            this.$store
                .dispatch("auth/login", { username, password })
                .then(() => {
                    this.$router.push({ name: "dashboard" });
                    this.$store.dispatch("snackbar/show", {
                        text: $t("Welcome back, ") + $auth.getUser().firstname,
                    });
                })
                .catch((err) => {
                    if (err.response) {
                        this.$refs["signin-form"].setErrors(
                            err.response.data.errors,
                        );
                    }
                })
                .finally(() => {
                    this.load(false);
                });

            e.preventDefault();
        },
    },
};
</script>
