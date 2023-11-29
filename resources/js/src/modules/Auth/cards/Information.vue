<script>
import $api from "../routes/api.js";
import AccountDetails from "@modules/Users/cards/AccountDetails.vue";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useAlertBoxStore } from "@components/Alert/store/alertbox.js";
import { useSuccessBoxStore } from "@components/Alert/store/successbox.js";
import { useSettingsStore } from "@/store/globals/settings.js";
import User from "@modules/Users/Models/User.js";
import { ref } from "vue";
import { useDisplay } from "vuetify";
import { useForm } from "vee-validate";
import { userSchema } from "@modules/Users/Schema/uservalidation.js";

export default {
    components: {
        AccountDetails,
    },

    setup() {
        const resource = ref(new User());

        const snackbar = useSnackbarStore();
        const dialog = useDialogStore();
        const { mdAndUp, xlAndUp } = useDisplay();
        const alertBox = useAlertBoxStore();
        const successBox = useSuccessBoxStore();
        const settings = useSettingsStore();

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
        const suffix = defineComponentBinds("suffix", vuetifyConfig);
        const prefix = defineComponentBinds("prefix", vuetifyConfig);
        const mobile = defineComponentBinds("mobile", vuetifyConfig);
        const username = defineComponentBinds("username", vuetifyConfig);
        const homeAddress = defineComponentBinds("homeAddress", vuetifyConfig);
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
                .post($api.update(), resource.value, {
                    headers: { "Content-Type": "multipart/form-data" },
                })
                .then((response) => {
                    this.resource.isPrestine = true;
                })
                .catch((err) => {
                    setErrors(err.response.data.errors);
                })
                .finally(() => {
                    this.load(false);
                });
        });

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
            settings,
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
            let id = this.$route.params.id;

            axios
                .get($api.get())
                .then(({ data }) => {
                    this.resource.data = data.data;
                    this.resource.loading = false;
                })
                .catch((err) => {
                    this.resource.loading = false;
                })
                .finally(() => {
                    this.resource.loading = false;
                });
        },

        parseResourceData(item) {
            let data = _.clone(item);

            let formData = new FormData(this.$refs["editAuth-form"].$el);

            data.details = Object.assign(
                {},
                data.details,
                data.details.others || {},
            );
            delete data.details.others;

            formData.append("username", data.username);
            formData.append("email", data.email);

            for (let i in data.details) {
                let c = data.details[i],
                    key = c.key,
                    icon = c.icon,
                    value =
                        c.value === undefined ||
                        c.value === "undefined" ||
                        c.value === "null" ||
                        c.value == null
                            ? ""
                            : c.value;

                formData.append(`details[${c.key}][key]`, key);
                formData.append(`details[${c.key}][icon]`, icon);
                formData.append(`details[${c.key}][value]`, value);
            }

            data = formData;

            return data;
        },

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

        submit(e) {
            this.load();
            e.preventDefault();
            this.alertBox.hide();
            this.load(false);
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
    <v-form
        ref="editAuth-form"
        :disabled="isLoading"
        autocomplete="false"
        enctype="multipart/form-data"
        @submit.prevent="onSubmit"
    >
        <button ref="submit-button" class="d-none" type="submit"></button>
        <page-header :back="{ to: { name: 'users.all' }, text: 'Users' }">
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
                                    :model-value="resource.data.prefixname"
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
                                    :model-value="resource.data.suffixname"
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
                                    :dense="settings.fieldIsDense"
                                    :disabled="isLoading"
                                    :model-value="resource.data.firstname"
                                    class="dt-text-field"
                                    label="First Name"
                                    outlined
                                    v-bind="firstname"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="resource.data.middlename"
                                    :dense="settings.fieldIsDense"
                                    :disabled="isLoading"
                                    :model-value="resource.data.middlename"
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
                                    :dense="settings.fieldIsDense"
                                    :disabled="isLoading"
                                    :model-value="resource.data.lastname"
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
                                <v-text-field
                                    v-model="
                                        resource.data.details['Mobile Phone']
                                            .value
                                    "
                                    :dense="settings.fieldIsDense"
                                    :disabled="isLoading"
                                    :model-value="
                                        resource.data.details['Mobile Phone']
                                            .value
                                    "
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
                                    v-model="
                                        resource.data.details['Home Address']
                                            .value
                                    "
                                    :dense="settings.fieldIsDense"
                                    :disabled="isLoading"
                                    :model-value="
                                        resource.data.details['Home Address']
                                            .value
                                    "
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

                <!--                <v-card>-->
                <!--                    <v-card-title class="pb-0">-->
                <!--                        Additional Background Details-->
                <!--                    </v-card-title>-->
                <!--                    <v-card-text>-->
                <!--                        &lt;!&ndash;                            :disabled="true"&ndash;&gt;-->
                <!--                        <repeater-->
                <!--                            v-model="resource.data.details.others"-->
                <!--                            :background-details="backgroundDetails"-->
                <!--                            :dense="settings.fieldIsDense"-->
                <!--                        ></repeater>-->
                <!--                    </v-card-text>-->
                <!--                </v-card>-->
            </v-col>
            <!--            <v-col cols="12" md="3">-->
            <!--                <v-card class="mb-3">-->
            <!--                    <v-card-title class="pb-0">Photo</v-card-title>-->
            <!--                    <v-card-text>-->
            <!--                        <upload-avatar-->
            <!--                            v-model="resource.data.avatar"-->
            <!--                            name="photo"-->
            <!--                        >-->
            <!--                        </upload-avatar>-->
            <!--                    </v-card-text>-->
            <!--                </v-card>-->
            <!--            </v-col>-->
        </v-row>
    </v-form>
</template>
