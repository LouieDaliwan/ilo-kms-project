<script>
import Admin from "@components/Layouts/Admin.vue";
import Metatag from "@components/Metatag/Metatag.vue";
import PageHeader from "@components/Headers/PageHeader.vue";
import AlertBox from "@components/Alert/AlertBox.vue";
import $api from "./routes/api.js";
import { useSnackbarStore } from "@components/Snackbar/store/snackbar.js";
import { useDialogStore } from "@components/Dialog/store/dialog.js";
import { useAlertBoxStore } from "@components/Alert/store/alertbox.js";
import { useSuccessBoxStore } from "@components/Alert/store/successbox.js";
import User from "./Models/User.js";
import { useDisplay } from "vuetify";

export default {
    components: {
        Admin,
        Metatag,
        PageHeader,
        AlertBox,
    },

    data() {
        return {
            resource: new User(),
        };
    },

    setup() {
        const snackbar = useSnackbarStore();
        const dialog = useDialogStore();
        const { mdAndUp } = useDisplay();
        const alertBox = useAlertBoxStore();
        const successBox = useSuccessBoxStore();

        return {
            snackbar,
            dialog,
            mdAndUp,
            alertBox,
            successBox,
        };
    },

    beforeRouteLeave(to, from, next) {
        if (this.isFormPrestine) {
            next();
        } else {
            this.askUserBeforeNavigatingAway(next);
        }
    },

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

        form() {
            return this.$refs["addform"];
        },
    },

    methods: {
        parseResourceData(item) {
            let data = _.clone(item);

            let formData = new FormData(this.$refs["addform-form"].$el);

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

        parseErrors(errors) {
            this.form.setErrors(errors);
            errors = Object.values(errors).flat();
            this.resource.hasErrors = errors.length;
            return errors;
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

            axios
                .post(
                    $api.store(),
                    this.parseResourceData(this.resource.data),
                    {
                        headers: { "Content-Type": "multipart/form-data" },
                    },
                )
                .then((response) => {
                    this.resource.isPrestine = true;

                    this.snackbar.show({
                        text: "User created successfully",
                    });

                    this.$router.push({
                        name: "users.edit",
                        params: {
                            id: response.data.data.id,
                        },
                        query: {
                            success: true,
                        },
                    });

                    this.successBox.show({
                        text: `Updated User ${response.data.data.displayname}`,
                        buttons: {
                            show: {
                                code: "users.show",
                                to: {
                                    name: "users.show",
                                    params: { id: response.data.data.id },
                                },
                                icon: "mdi-account-search-outline",
                                text: "View Details",
                            },
                            create: {
                                code: "users.create",
                                to: { name: "users.create" },
                                icon: "mdi-account-plus-outline",
                                text: "Add New User",
                            },
                        },
                    });
                })
                .catch((err) => {
                    this.form.setErrors(err.response.data.errors);
                })
                .finally(() => {
                    this.load(false);
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

        load(val = true) {
            this.resource.loading = val;
        },
    },
    watch: {
        "resource.data": {
            handler(val) {
                this.resource.isPrestine = false;
                this.resource.hasErrors = this.$refs.addform.flags.invalid;
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

        <template v-slot:appbar>
            <v-container class="py-0 px-0">
                <v-row align="center" justify="space-between">
                    <v-fade-transition>
                        <v-col
                            v-if="isNotFormPrestine"
                            class="py-0"
                            cols="auto"
                        >
                            <v-toolbar-title class="muted--text">
                                Unsaved changes
                            </v-toolbar-title>
                        </v-col>
                    </v-fade-transition>
                    <v-spacer></v-spacer>
                    <v-col class="py-0" cols="auto">
                        <div class="d-flex justify-end">
                            <v-spacer></v-spacer>
                            <v-btn
                                class="ml-3 mr-0"
                                large
                                text
                                @click="askUserToDiscardUnsavedChanges"
                                >Discard
                            </v-btn>
                            <!--                            v-model="shortkeyCtrlIsPressed"-->
                            <v-badge
                                bordered
                                bottom
                                class="dt-badge"
                                color="dark"
                                content="s"
                                offset-x="20"
                                offset-y="20"
                                tile
                                transition="fade-transition"
                            >
                                <!--                                v-shortkey.once="['ctrl', 's']"
                                                        @shortkey="submitForm"
                                -->
                                <v-btn
                                    ref="submit-button-main"
                                    :disabled="isFormDisabled"
                                    :loading="isLoading"
                                    class="ml-3 mr-0"
                                    color="primary"
                                    large
                                    type="submit"
                                    @click.prevent="submitForm"
                                >
                                    <v-icon left
                                        >mdi-content-save-outline
                                    </v-icon>
                                    Save
                                </v-btn>
                            </v-badge>
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </template>

        <validation-observer
            ref="addform"
            v-slot="{ handleSubmit, errors, invalid, passed }"
        >
            <v-form
                ref="addform-form"
                :disabled="isLoading"
                autocomplete="false"
                enctype="multipart/form-data"
                v-on:submit.prevent="handleSubmit(submit($event))"
            >
                <button
                    ref="submit-button"
                    class="d-none"
                    type="submit"
                ></button>
                <page-header
                    :back="{ to: { name: 'users.all' }, text: 'Users' }"
                >
                    <template v-slot:title>Add User</template>
                </page-header>

                <alert-box></alert-box>
            </v-form>
        </validation-observer>
    </admin>
</template>
