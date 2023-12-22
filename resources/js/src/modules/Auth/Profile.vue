<script setup>
import ProfileInformation from "./cards/Information.vue";
import ChangePassword from "./ChangePassword.vue";
</script>
<template>
    <admin>
        <metatag :title="'User Profile'"></metatag>
                <template v-slot:appbar>
            <!-- <v-container class="py-0 px-0">
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
                        <div class="d-flex justify-end mr-6">
                            <v-spacer></v-spacer>
                            <v-btn
                                class="ml-3 mr-0"
                                large
                                text
                                @click="askUserToDiscardUnsavedChanges"
                                >Discard
                            </v-btn>

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
                                <v-icon left>mdi-content-save-outline</v-icon>
                                Save
                            </v-btn>
                        </div>
                    </v-col>
                </v-row>
            </v-container> -->
        </template>
        <ProfileInformation />
        <ChangePassword />
    </admin>
</template>
