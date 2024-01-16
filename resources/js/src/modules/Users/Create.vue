<script>
import $api from "./routes/api.js";
import AccountDetails from "./cards/AccountDetails.vue";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useAlertBoxStore } from "@components/Alert/store/alertbox.js";
import { useSuccessBoxStore } from "@components/Alert/store/successbox.js";
// import { useSettingsStore } from "@/store/globals/settings.js";
import User from "./Models/User.js";
import { ref } from "vue";
import { useDisplay } from "vuetify";
import { useForm } from "vee-validate";
import Swal from "sweetalert2";
import { userSchema } from "./Schema/uservalidation.js";
import { useRouter } from "vue-router";

export default {
    components: {
        AccountDetails,
    },

    setup() {
        const resource = ref(new User());
        const isPrestine = ref(false);
        const router = useRouter();
        const snackbar = useSnackbarStore();
        const dialog = useDialogStore();
        const { mdAndUp, xlAndUp } = useDisplay();
        const alertBox = useAlertBoxStore();
        const successBox = useSuccessBoxStore();

        const { defineComponentBinds, handleSubmit, resetForm, setErrors } =
            useForm({
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
        const backgroundDetails = defineComponentBinds(
            "backgroundDetails",
            vuetifyConfig,
        );

        const onSubmit = handleSubmit((values) => {
            axios
                .post($api.store(), resource.value, {
                    headers: { "Content-Type": "multipart/form-data" },
                })
                .then(({ data }) => {
                    isPrestine.value = true;

                    // this.snackbar.show({
                    //     text: "User created successfully",
                    // });

                    router.push({
                        name: "users.show",
                        params: {
                            id: data.id,
                        },
                        query: {
                            success: true,
                        },
                    });

                    // this.successBox.show({
                    //     text: `Updated User ${response.data.data.displayname}`,
                    //     buttons: {
                    //         show: {
                    //             code: "users.show",
                    //             to: {
                    //                 name: "users.show",
                    //                 params: { id: response.data.data.id },
                    //             },
                    //             icon: "mdi-account-search-outline",
                    //             text: "View Details",
                    //         },
                    //         create: {
                    //             code: "users.create",
                    //             to: { name: "users.create" },
                    //             icon: "mdi-account-plus-outline",
                    //             text: "Add New User",
                    //         },
                    //     },
                    // });
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
                    Swal.fire({
                    title: "Success!",
                    text: "You have successfully added a new user.",
                    icon: "success",
                    confirmButtonColor:"#1E2DBE"
                    });
                });
        });

        return {
            snackbar,
            dialog,
            mdAndUp,
            xlAndUp,
            alertBox,
            successBox,
            resetForm,
            firstname,
            username,
            lastname,
            suffix,
            prefix,
            backgroundDetails,
            email,
            resource,
            password,
            confirm_password,
            homeAddress,
            mobile,
            onSubmit,
            roleValidation,
            isPrestine,
            // settings,
        };
    },

    beforeRouteLeave(to, from, next) {
        console.log(this.isPrestine.value);
        // if (resource.isPrestine) {
        //     next();
        // } else {
        //     this.askUserBeforeNavigatingAway(next);
        // }
        next();
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
            return this.isInvalid || this.isPrestine;
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

    methods: {
        submitForm() {
            if (this.isNotFormDisabled) {
                this.$refs["submit-button"].click();
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: "smooth",
                });
            }
        },

        askUserBeforeNavigatingAway(next) {
            this.dialog.show({
                illustration: () =>
                    import("@components/Icons/WorkingDeveloperIcon.vue"),
                title: "Unsaved changes will be lost",
                text: "You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.",
                buttons: {
                    cancel: {
                        text: "Go Back",
                        callback: () => {
                            this.dialog.hide();
                        },
                    },
                    action: {
                        text: "Discard",
                        callback: () => {
                            next();
                            this.dialog.hide();
                        },
                    },
                },
            });
        },

        askUserToDiscardUnsavedChanges() {
            this.dialog.show({
                illustration: () =>
                    import("@/components/Icons/WorkingDeveloperIcon.vue"),
                title: "Discard changes?",
                text: "You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        callback: () => {
                            this.dialog.hide();
                        },
                    },
                    action: {
                        text: "Discard",
                        callback: () => {
                            this.resource.isPrestine = true;
                            this.dialog.hide();
                            this.$router.replace({ name: "users.all" });
                        },
                    },
                },
            });
        },

        load(val = true) {
            this.resource.loading = val;
        },
    },
    watch: {
        "resource.data": {
            handler(val) {
                this.resource.isPrestine = false;
                // this.resource.hasErrors = this.$refs.addform.flags.invalid;
                if (!this.resource.hasErrors) {
                    this.alertBox.hide();
                }
            },
            deep: true,
        },
    },
};
</script>
<template>
    <admin>
        <metatag :title="'Add User'"></metatag>

        <v-form
            ref="addform-form"
            :disabled="isLoading"
            autocomplete="false"
            enctype="multipart/form-data"
            @submit.prevent="onSubmit"
            class="txtfield-border"
        >
            <button ref="submit-button" class="d-none" type="submit"></button>
            <page-header :back="{ to: { name: 'users.all' }, text: 'Users' }">
                <template v-slot:title>Add User</template>
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
                                        class="dt-text-field"
                                        label="First Name"
                                        outlined
                                        v-bind="firstname"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        v-model="resource.data.middlename"
                                        :disabled="isLoading"
                                        class="dt-text-field"
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
                                        class="dt-text-field"
                                        label="Last name"
                                        name="lastname"
                                        outlined
                                        v-bind="lastname"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="center">
                                <v-col cols="12">
                                    <!--                                        :dense="settings.fieldIsDense"-->
                                    <v-text-field
                                        v-model="resource.data.mobile_phone"
                                        :disabled="isLoading"
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
                                    <!--                                  :dense="settings.fieldIsDense"-->
                                    <v-text-field
                                        v-model="resource.data.home_address"
                                        :disabled="isLoading"
                                        class="dt-text-field"
                                        cols="12"
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

                    <!--                    <v-card>-->
                    <!--                        <v-card-title class="pb-0">-->
                    <!--                            Additional Background Details-->
                    <!--                        </v-card-title>-->
                    <!--                        <v-card-text>-->
                    <!--                            &lt;!&ndash;                          :dense="settings.fieldIsDense"&ndash;&gt;-->
                    <!--                            <repeater-->
                    <!--                                v-model="resource.data.details.others"-->
                    <!--                                :background-details="backgroundDetails"-->
                    <!--                                :disabled="true"-->
                    <!--                            ></repeater>-->
                    <!--                        </v-card-text>-->
                    <!--                    </v-card>-->
                </v-col>
                <v-col cols="12" md="3">
                    <!--                    <v-card class="mb-3">-->
                    <!--                        <v-card-title class="pb-0">Photo</v-card-title>-->
                    <!--                        <v-card-text>-->
                    <!--                            <upload-avatar-->
                    <!--                                v-model="resource.data.avatar"-->
                    <!--                                name="photo"-->
                    <!--                            >-->
                    <!--                            </upload-avatar>-->
                    <!--                        </v-card-text>-->
                    <!--                    </v-card>-->

                    <!--                  :disabled="isLoading"-->
                    <!--                        :dense="settings.fieldIsDense"-->
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
                ref="submit-button-main"
                :disabled="isFormDisabled"
                :loading="isLoading"
                color="primary"
                large
                type="submit"
                @click.prevent="onSubmit" block class="mt-2">
                Submit
            </v-btn>
        </v-form>
    </admin>
</template>
