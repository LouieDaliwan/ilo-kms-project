<script>
import $api from "../routes/api.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useAlertBoxStore } from "@components/Alert/store/alertbox.js";
import { useSuccessBoxStore } from "@components/Alert/store/successbox.js";
import { useSettingsStore } from "@/store/globals/settings.js";
import User from "@modules/Users/Models/User.js";
import { ref } from "vue";
import { useDisplay } from "vuetify";
import { useForm } from "vee-validate";
import { useInformationSchema } from "../Schema/updateInformationValidation.js";

export default {
    data() {
        return {
            isDisable: true
        };
    },
    setup() {

        const resource = ref(new User());

        const snackbar = useSnackbarStore();
        const dialog = useDialogStore();
        const { mdAndUp, xlAndUp } = useDisplay();
        const alertBox = useAlertBoxStore();
        const successBox = useSuccessBoxStore();
        const settings = useSettingsStore();

        const {
            defineComponentBinds,
            handleSubmit,
            resetForm,
            setValues,
            setErrors,
        } = useForm({
            validationSchema: useInformationSchema,
        });

        const vuetifyConfig = (state) => ({
            props: {
                "error-messages": state.errors,
            },
        });

        // TODO fix this @author Louie Daliwan
        const firstname = defineComponentBinds("firstname", vuetifyConfig);
        const middlename = defineComponentBinds("middlename", vuetifyConfig);
        const lastname = defineComponentBinds("lastname", vuetifyConfig);
        const email = defineComponentBinds("email", vuetifyConfig);
        const suffix = defineComponentBinds("suffixname", vuetifyConfig);
        const prefix = defineComponentBinds("prefixname", vuetifyConfig);
        const mobile = defineComponentBinds("mobile_number", vuetifyConfig);
        const username = defineComponentBinds("username", vuetifyConfig);
        const homeAddress = defineComponentBinds("home_address", vuetifyConfig);

        const load = (val = true) => {
            resource.loading = val;
        };

        const onSubmit = handleSubmit((values) => {
            load();
            axios
                .post($api.updateInformation(), parseResourceData(values), {
                    headers: { "Content-Type": "multipart/form-data" },
                })
                .then(({ data }) => {
                    this.resource.isPrestine = true;
                    this.resource.data = data.data;
                    setValues(this.resource.data);
                })
                .catch((err) => {
                    setErrors(err.response.data.errors);
                })
                .finally(() => {
                    load(false);
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
            return data;
        };

        return {
            snackbar,
            dialog,
            mdAndUp,
            xlAndUp,
            alertBox,
            successBox,
            handleSubmit,
            resetForm,
            firstname,
            middlename,
            username,
            lastname,
            suffix,
            prefix,
            email,
            resource,
            homeAddress,
            mobile,
            onSubmit,
            settings,
            setValues,
            load,
        };
    },

    // beforeRouteLeave(to, from, next) {
    //     if (this.isFormPrestine) {
    //         next();
    //         console.log("test");
    //     } else {
    //         console.log("test2");
    //         this.askUserBeforeNavigatingAway(next);
    //     }
    // },

    computed: {
        isDesktop() {
            return this.mdAndUp;
        },
        isInvalid() {
            return this.resource.isPrestine || this.resource.loading;
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

            axios
                .get($api.get())
                .then(({ data }) => {
                    this.resource.data = data.data;
                    this.setValues(this.resource.data);
                    this.resource.loading = false;
                })
                .catch((err) => {
                    this.resource.loading = false;
                })
                .finally(() => {
                    this.resource.loading = false;
                });
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

        onInput() {
            this.isDisable = false;
        },
    },
};
</script>
<template>
    <v-form
        ref="editAuth-form"
        :disabled="isLoading"
        autocomplete="false"
        enctype="multipart/form-data"
         @input="onInput"
        @submit.prevent="onSubmit"
        class="txtfield-border"
    >
        <page-header :back="{ to: { name: 'users.all' }, text: 'Users', }">
            <template v-slot:title>My Profile</template>
        </page-header>

        <alert-box></alert-box>

        <v-row>
            <v-col cols="12" md="12">
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
                                <text-field
                                    v-model="resource.data.suffix"
                                    :attributeName="suffix"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Suffix'"
                                    :name="'suffixname'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="resource.data.firstname"
                                    :attributeName="firstname"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'First Name'"
                                    :name="'firstname'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="resource.data.middlename"
                                    :attributeName="middlename"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Middle Name'"
                                    :name="'middlename'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="resource.data.lastname"
                                    :attributeName="lastname"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Last Name'"
                                    :name="'lastname'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <text-field
                                    v-model="resource.data.email"
                                    :attributeName="email"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Email'"
                                    :name="'email'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12">
                                <text-field
                                    v-model="resource.data.username"
                                    :attributeName="username"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Username'"
                                    :name="'username'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row align="center">
                            <v-col cols="12">
                                <text-field
                                    v-model="resource.data.mobile_number"
                                    :attributeName="mobile"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Mobile Phone'"
                                    :name="'mobile_number'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <text-field
                                    v-model="resource.data.home_address"
                                    :attributeName="homeAddress"
                                    :disabled="isLoading"
                                    :isDense="settings.fieldIsDense"
                                    :label="'Home Address'"
                                    :name="'home_address'"
                                ></text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-btn block class="mt-2" color="primary" :disabled="isDisable" type="submit">Submit</v-btn>
    </v-form>
</template>
