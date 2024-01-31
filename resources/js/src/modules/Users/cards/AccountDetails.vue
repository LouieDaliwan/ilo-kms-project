<script>
export default {
    name: "AccountDetails",
    emits: ["update:modelValue"],
    props: [
        "modelValue",
        "email",
        "username",
        "password",
        "confirm_password",
        "xlAndUp",
    ],

    computed: {
        resource: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit("update:modelValue", val);
            },
        },

        hasPassword() {
            return this.resource.password;
        },

        confirmed() {
            return (
                this.resource.password == this.resource.password_confirmation
            );
        },

        isDense: function () {
            return this.xlAndUp;
        },
    },
};
</script>

<template>
    <v-card class="mb-3">
        <v-card-title>Account Details</v-card-title>
        <v-card-subtitle class="muted--text"
            >Fields will be used to sign in to the app
        </v-card-subtitle>
        <v-card-text>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="resource.data.email"
                        :dense="isDense"
                        :value="resource.data.email"
                        class="dt-text-field"
                        label="Email address"
                        name="email"
                        outlined
                        prepend-inner-icon="mdi-email-outline"
                        type="email"
                        v-bind="email"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        v-model="resource.data.username"
                        :dense="isDense"
                        :value="resource.data.username"
                        autocomplete="off"
                        class="dt-text-field"
                        label="Username"
                        name="username"
                        outlined
                        prepend-inner-icon="mdi-account-outline"
                        v-bind="username"
                    >
                    </v-text-field>
                </v-col>
                <!--                <v-col v-if="hasPassword" :md="confirmed ? 6 : 12" cols="12">-->
                <v-col cols="12" md="6">
                    <v-text-field
                        ref="password"
                        v-model="resource.data.password"
                        :dense="isDense"
                        autocomplete="new-password"
                        class="dt-text-field"
                        label="Password"
                        name="password"
                        outlined
                        prepend-inner-icon="mdi-lock"
                        type="password"
                        v-bind="password"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field
                        v-model="resource.data.password_confirmation"
                        :dense="isDense"
                        autocomplete="new-password"
                        class="dt-text-field"
                        label="Retype Password"
                        name="password_confirmation"
                        outlined
                        prepend-inner-icon="mdi-lock"
                        type="password"
                        v-bind="confirm_password"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>
