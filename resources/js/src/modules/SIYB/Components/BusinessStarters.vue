<script>
export default {
    props: ["dataSummary"],

    data() {
        return {
            businessStart: this.dataSummary.businessStart,
        };
    },
};
</script>

<template>
    <div class="mt-10">
        <h3 class="text-tertiary-color">Business Starters</h3>

        <v-row class="mt-5">
            <v-col>
                <h4 class="chart-title">Do you have a concrete and feasible business idea</h4>
                <Bar
                    :name="'starters-1'"
                    :values="businessStart.concrete_feasible_business_idea"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title">Do you have a business plan</h4>
                <Bar
                    v-if="dataSummary"
                    :name="'starters-2'"
                    :values="businessStart.do_you_have_a_business_plan"
                />
            </v-col>
        </v-row>

        <v-row class="mt-9">
            <v-col>
                <h4 class="chart-title">Have you sold anything online?</h4>
                <Bar
                    v-if="dataSummary"
                    :name="'starters-3'"
                    :values="businessStart.sold_anything_online"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title">
                    In your new business to be started, do you plan to sell
                    online?
                </h4>
                <Bar
                    v-if="dataSummary"
                    :name="'starters-4'"
                    :values="businessStart.sell_online"
                />
            </v-col>
        </v-row>

        <v-row class="mt-9">
            <v-col>
                <h4 class="chart-title mb-3">
                    In your new business to be started, do you plan to use
                    e-wallets and digital financial services?
                </h4>
                <Bar
                    v-if="dataSummary"
                    :name="'starters-5'"
                    :values="businessStart.digital_financial_services"
                />
            </v-col>

            <v-col>
                <h4 class="chart-title mb-3">
                    In your new business to be started, do you plan to use
                    digital tools/apps to manage the business operations?
                </h4>
                <Bar
                    v-if="dataSummary"
                    :name="'starters-6'"
                    :values="businessStart.digital_tools_apps"
                />
            </v-col>
        </v-row>
    </div>
</template>
