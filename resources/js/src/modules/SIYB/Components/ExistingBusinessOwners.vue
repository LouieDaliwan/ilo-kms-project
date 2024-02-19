<script setup>
import { ref } from "vue";

const businessStart = ref({
    Yes: 20,
    No: 30,
});
</script>

<template>
    <div class="mt-10">
        <h1>Business Starters</h1>

        <v-row class="mt-5">
            <v-col>
                <h4>What is your current line of business</h4>
                <Bar :name="'business-owners-1'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>What type of business is it</h4>
                <Bar :name="'business-owners-2'" :values="businessStart" />
            </v-col>
            <v-col>
                <h4>Is your business registered</h4>
                <Bar :name="'business-owners-3'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>Digitalized record keeping system/app</h4>
                <Bar :name="'business-owners-4'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>Digitalized buying and stock control system/app</h4>
                <Bar :name="'business-owners-5'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>
                    Using social media and messenger platforms to stay visible
                    and communicate with clients
                </h4>
                <Bar :name="'business-owners-6'" :values="businessStart" />
            </v-col>
            <v-col>
                <h4>Having a website</h4>
                <Bar :name="'business-owners-7'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>
                    Promoting the business with digital marketing and branding
                </h4>
                <Bar :name="'business-owners-8'" :values="businessStart" />
            </v-col>
            <v-col>
                <h4>Selling online via social media platforms</h4>
                <Bar :name="'business-owners-9'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>Selling online via marketplaces</h4>
                <Bar :name="'business-owners-10'" :values="businessStart" />
            </v-col>
            <v-col>
                <h4>Selling online via business website</h4>
                <Bar :name="'business-owners-11'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>Using payment gateways and/or processors to sell online</h4>
                <Bar :name="'business-owners-12'" :values="businessStart" />
            </v-col>
            <v-col>
                <h4>
                    Having defined policies concerning digital ethics, trust and
                    security
                </h4>
                <Bar :name="'business-owners-13'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>
                    What are your plans for your existing business in the near
                    future
                </h4>
                <Bar :name="'business-owners-14'" :values="businessStart" />
            </v-col>
        </v-row>
    </div>
</template>
