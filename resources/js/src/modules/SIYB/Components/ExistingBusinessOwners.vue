<script>
export default {
    props: ["dataSummary"],
    data() {
        return {
            businessOwners: this.dataSummary.businessOwners,
        };
    },
};
</script>

<template>
    <div class="mt-10">
        <h3 class="text-tertiary-color">Exist Business Owners</h3>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title">What is your current line of business</h4>
                <Bar
                    :name="'business-owners-1'"
                    :values="businessOwners.current_line_business"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title">What type of business is it</h4>
                <Bar
                    :name="'business-owners-2'"
                    :values="businessOwners.type_of_business"
                />
            </v-col>
            <v-col>
                <h4 class="chart-title">Is your business registered</h4>
                <Bar
                    :name="'business-owners-3'"
                    :values="businessOwners.business_registered"
                />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title">Digitalized record keeping system/app</h4>
                <Bar
                    :name="'business-owners-4'"
                    :values="businessOwners.digitalized_record"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title">Digitalized buying and stock control system/app</h4>
                <Bar
                    :name="'business-owners-5'"
                    :values="businessOwners.digitalized_buying"
                />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title mb-3">
                    Using social media and messenger platforms to stay visible
                    and communicate with clients
                </h4>
                <Bar
                    :name="'business-owners-6'"
                    :values="businessOwners.socmed"
                />
            </v-col>
            <v-col>
                <h4 class="chart-title">Having a website</h4>
                <Bar
                    :name="'business-owners-7'"
                    :values="businessOwners.having_a_website"
                />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title">
                    Promoting the business with digital marketing and branding
                </h4>
                <Bar
                    :name="'business-owners-8'"
                    :values="businessOwners.promoting"
                />
            </v-col>
            <v-col>
                <h4 class="chart-title">Selling online via social media platforms</h4>
                <Bar
                    :name="'business-owners-9'"
                    :values="businessOwners.selling_socmed"
                />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title">Selling online via marketplaces</h4>
                <Bar
                    :name="'business-owners-10'"
                    :values="businessOwners.selling_marketplace"
                />
            </v-col>
            <v-col>
                <h4 class="chart-title">Selling online via business website</h4>
                <Bar
                    :name="'business-owners-11'"
                    :values="businessOwners.selling_website"
                />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title mb-3">Using payment gateways and/or processors to sell online</h4>
                <Bar
                    :name="'business-owners-12'"
                    :values="businessOwners.using_payment"
                />
            </v-col>
            <v-col>
                <h4 class="chart-title mb-3">
                    Having defined policies concerning digital ethics, trust and
                    security
                </h4>
                <Bar
                    :name="'business-owners-13'"
                    :values="businessOwners.having_defined_policies"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title mb-3">
                    What are your plans for your existing business in the near
                    future
                </h4>
                <Bar
                    :name="'business-owners-14'"
                    :values="businessOwners.plans_existing_future_business"
                />
            </v-col>
        </v-row>
    </div>
</template>
