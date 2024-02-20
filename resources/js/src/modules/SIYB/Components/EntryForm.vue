<script>
export default {
    props: ["dataSummary"],
    data() {
        return {
            entryForm: this.dataSummary.entryForm,
            age: ["16-25", "26-35", "36-45", "46-60", "60>"],
            gender: ["Male", "Female"],
        };
    },
};
</script>

<template>
    <div class="mt-10">
        <h1>Entry Form</h1>

        <v-row class="mt-5">
            <v-col>
                <h4 class="text-secondary">
                    <p>Gender</p>
                </h4>
                <Bar
                    :name="'entry-form-g'"
                    :values="entryForm.gender"
                    class="mt-10"
                />
            </v-col>
            <v-col>
                <h4 class="text-secondary">
                    <p>Age</p>
                </h4>
                <Bar
                    :name="'entry-form-a'"
                    :values="entryForm.age"
                    class="mt-10"
                />
            </v-col>
        </v-row>
        <v-row class="mt-5">
            <v-col>
                <h4>Which digital devices do you have?</h4>
                <Bar
                    :name="'entry-form-digital-1'"
                    :values="entryForm.digitalDevices"
                />
            </v-col>

            <v-col>
                <h4>What level of internet access do you currently have?</h4>
                <Bar
                    :name="'entry-form-internet-2'"
                    :values="entryForm.connection"
                />
            </v-col>
        </v-row>
    </div>
</template>
