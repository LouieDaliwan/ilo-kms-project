<template>
    <!--  :error-messages="errors"-->
    <v-form :disabled="loading" v-on:submit.prevent="submit">
        <v-text-field
            v-model="auth.email"
            autofocus
            class="mb-3"
            clear-icon="mdi mdi-close-circle-outline"
            clearable
            label="Email or Username"
            outlined
        ></v-text-field>

        <!--            :error-messages="errors"-->
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
            Sign In
            <template v-slot:loader>
                <v-slide-x-transition>
                    <v-icon class="mdi-spin mr-3" dark>mdi-loading</v-icon>
                </v-slide-x-transition>
                <span>Signing in...</span>
            </template>
        </v-btn>
    </v-form>
</template>

<script>
import { useDisplay } from "vuetify";
import { computed } from "vue";

export default {
    name: "Login",

    data: () => ({
        auth: {
            email: "",
            password: "",
        },
        loading: false,
        showPassword: false,
    }),

    setup() {
        const { smAndDown } = useDisplay();

        const isMobile = computed({
            get: () => !!smAndDown,
            set: (val) => !!smAndDown,
        });
        return { smAndDown, isMobile };
    },

    methods: {
        load(val = true) {
            this.loading = val;
        },

        submit(e) {
            const { email, password } = this.auth;

            this.load();
            axios
                .post("/login", { email, password })
                .then(({ data }) => {
                    localStorage.setItem("auth", data.auth);
                    localStorage.setItem("two_factor", data.two_factor);

                    this.$router.push({ name: "dashboard" });
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.load(false);
                });

            e.preventDefault();
        },
        // this.$store
        //     .dispatch("auth/login", { username, password })
        //     .then(() => {
        //         this.$router.push({ name: "dashboard" });
        //         this.$store.dispatch("snackbar/show", {
        //             text: "Welcome back, " + $auth.getUser().firstname,
        //         });
        //     })
        //     .catch((err) => {
        //         if (err.response) {
        //             this.$refs["signin-form"].setErrors(
        //                 err.response.data.errors,
        //             );
        //         }
        //     })
        //     .finally(() => {
        //         this.load(false);
        //     });
    },
};
</script>
