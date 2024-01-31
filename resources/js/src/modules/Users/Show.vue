<script>
import $api from "./routes/api.js";
import AccountDetails from "./cards/AccountDetails.vue";
import User from "./Models/User.js";
import { ref } from "vue";
import { useDisplay } from "vuetify";
import { useForm } from "vee-validate";
import { userSchema } from "./Schema/uservalidation.js";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";

export default {
    components: {
        AccountDetails,
    },

    setup() {
        const resource = ref(new User());
        const isPrestine = ref(false);
        const { mdAndUp, xlAndUp } = useDisplay();
        const router = useRouter();

        const {
            defineComponentBinds,
            handleSubmit,
            resetForm,
            setValues,
            setErrors,
        } = useForm({
            validationSchema: userSchema,
        });

        const vuetifyConfig = (state) => ({
            props: {
                "error-messages": state.errors,
            },
        });

        // TODO fix this @author Louie Daliwan
        const firstname = defineComponentBinds("firstname", vuetifyConfig);
        const lastname = defineComponentBinds("lastname", vuetifyConfig);
        const email = defineComponentBinds("email", vuetifyConfig);
        const password = defineComponentBinds("password", vuetifyConfig);
        const suffix = defineComponentBinds("suffixname", vuetifyConfig);
        const prefix = defineComponentBinds("prefixname", vuetifyConfig);
        const mobile = defineComponentBinds("mobile_number", vuetifyConfig);
        const username = defineComponentBinds("username", vuetifyConfig);
        const homeAddress = defineComponentBinds("home_address", vuetifyConfig);
        const roleValidation = defineComponentBinds("roles", vuetifyConfig);
        const confirm_password = defineComponentBinds(
            "confirm_password",
            vuetifyConfig,
        );

        const onSubmit = handleSubmit((values) => {
            isPrestine.value = false;

            axios
                .post(
                    $api.update(router.currentRoute.value.params.id),
                    parseResourceData(values),
                    {
                        headers: { "Content-Type": "multipart/form-data" },
                    },
                )
                .then((response) => {
                    isPrestine.value = true;

                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Update.",
                        icon: "success",
                        confirmButtonColor: "#1E2DBE",
                    });
                })
                .catch((err) => {
                    setErrors(err.response.data.errors);
                })
                .finally(() => {
                    // this.load(false);
                    window.scrollTo({
                        top: 0,
                        left: 0,
                        behavior: "smooth",
                    });
                });
        });

        const parseResourceData = (values) => {
            let data = new FormData();
            data.append("_method", "PUT");
            data.append("firstname", values.firstname);
            data.append("middlename", values.middlename);
            data.append("lastname", values.lastname);
            data.append("email", values.email);
            data.append("suffixname", values.suffixname);
            data.append("prefixname", values.prefixname);
            data.append("mobile_number", values.mobile_number);
            data.append("username", values.username);
            data.append("home_address", values.home_address);
            data.append("password", values.password);
            data.append("confirm_password", values.confirm_password);
            data.append("roles", values.roles);
            return data;
        };

        return {
            mdAndUp,
            xlAndUp,
            handleSubmit,
            resetForm,
            firstname,
            username,
            lastname,
            suffix,
            prefix,
            email,
            resource,
            password,
            confirm_password,
            homeAddress,
            mobile,
            onSubmit,
            roleValidation,
            isPrestine,
            setValues,
        };
    },

    computed: {
        isDesktop() {
            return this.mdAndUp;
        },
        isInvalid() {
            return this.isPrestine || this.resource.loading;
        },
        isLoading() {
            return this.resource.loading;
        },
        isFormDisabled() {
            return this.isInvalid || this.resource.isPrestine;
        },
        isNotFormDisabled() {
            return !this.isFormDisabled;
        },
        isFormPrestine() {
            return this.resource.isPrestine;
        },
        isNotFormPrestine() {
            return !this.isFormPrestine;
        },
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            this.resource.loading = true;
            let id = this.$route.params.id;

            axios
                .get($api.show(id))
                .then(({ data }) => {
                    this.resource.data = data.data;
                    this.setValues(data.data);
                    this.resource.loading = false;
                })
                .catch((err) => {
                    this.resource.loading = false;
                    console.log(err);
                })
                .finally(() => {
                    this.resource.loading = false;
                });
        },

        load(val = true) {
            this.resource.loading = val;
        },
    },
};
</script>
<template>
    <admin>
        <metatag :title="'Show User'"></metatag>

        <v-form
            ref="editform-form"
            :disabled="isLoading"
            autocomplete="false"
            enctype="multipart/form-data"
            @submit.prevent="onSubmit"
        >
            <button ref="edit-submit-button" type="submit" @click="onSubmit">
                test
            </button>
            <page-header :back="{ to: { name: 'users.all' }, text: 'Users' }">
                <template v-slot:title>User Information</template>
            </page-header>

            <alert-box></alert-box>

            <v-row>
                <v-col cols="12" md="9">
                    <v-card class="mb-3">
                        <v-card-title>Account Information</v-card-title>
                        <v-card-text>
                            <v-row justify="space-between">
                                <v-col cols="6" md="2">
                                    <v-select
                                        v-model="resource.data.prefixname"
                                        :disabled="isLoading"
                                        :items="['Mr.', 'Ms.', 'Mrs.']"
                                        :value="resource.data.prefixname"
                                        background-color="selects"
                                        class="dt-text-field"
                                        dense
                                        hide-details
                                        label="Prefix"
                                        name="prefixname"
                                        outlined
                                        v-bind="prefix"
                                    ></v-select>
                                </v-col>
                                <v-col cols="6" md="2">
                                    <v-text-field
                                        v-model="resource.data.suffixname"
                                        :disabled="isLoading"
                                        :value="resource.data.suffixname"
                                        class="dt-text-field"
                                        dense
                                        hide-details
                                        label="Suffix"
                                        name="suffixname"
                                        outlined
                                        v-bind="suffix"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        v-model="resource.data.firstname"
                                        :disabled="isLoading"
                                        :value="resource.data.firstname"
                                        class="dt-text-field"
                                        dense
                                        label="First Name"
                                        outlined
                                        v-bind="firstname"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        v-model="resource.data.middlename"
                                        :disabled="isLoading"
                                        :value="resource.data.middlename"
                                        class="dt-text-field"
                                        dense
                                        hide-details
                                        label="Middle Name"
                                        name="middlename"
                                        outlined
                                    >
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        v-model="resource.data.lastname"
                                        :disabled="isLoading"
                                        :value="resource.data.lastname"
                                        class="dt-text-field"
                                        dense
                                        label="Last name"
                                        name="lastname"
                                        outlined
                                        v-bind="lastname"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="resource.data.mobile_number"
                                        :disabled="isLoading"
                                        :value="resource.data.mobile_number"
                                        class="dt-text-field"
                                        dense
                                        label="Mobile Phone"
                                        name="mobile_phone"
                                        outlined
                                        v-bind="mobile"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="resource.data.home_address"
                                        :disabled="isLoading"
                                        :value="resource.data.home_address"
                                        class="dt-text-field"
                                        cols="12"
                                        dense
                                        label="Home Address"
                                        v-bind="homeAddress"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                    <account-details
                        v-model="resource"
                        :confirm_password="confirm_password"
                        :email="email"
                        :password="password"
                        :username="username"
                        :xlAndUp="xlAndUp"
                    ></account-details>
                </v-col>
                <v-col cols="12" md="3">
                    <role-picker
                        v-model="resource.data.roles"
                        :lazyLoad="false"
                        :multiple="false"
                        :roleValidation="roleValidation"
                        class="mb-3"
                    ></role-picker>
                </v-col>
            </v-row>
            <v-btn
                ref="update-button-main"
                block
                class="mt-2"
                color="primary"
                large
                @click.prevent="onSubmit"
            >
                Update
            </v-btn>
        </v-form>
    </admin>
</template>
