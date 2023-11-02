<template>
    <section>
        <v-row align="center" justify="center">
            <v-col class="d-none d-md-flex pa-0" cols="12" md="6">
                <v-img
                    :lazy-src="require('@/components/Illustration/exce.jpg')"
                    :src="require('@/components/Illustration/exce.jpg')"
                    gradient="to top right, rgba(4, 75, 127, 0.3), rgba(16, 125, 125, 0.3)"
                    height="100vh"
                >
                </v-img>
            </v-col>

            <v-col :pa-5="$vuetify.breakpoint.smAndDown" cols="12" md="6">
                <!-- <bubble-1 style="transform: rotate(180deg) translateY(25%)"></bubble-1> -->
                <!-- <div>
                  <img
                    :src="require('@/components/Illustration/bubbles1.png')"
                    style="position: absolute; top: 0; right: 0; width: 300px;"
                    >
                </div> -->

                <v-row align="center" justify="center">
                    <v-col cols="12" md="7">
                        <v-card-text>
                            <div class="text-center">
                                <brand></brand>
                            </div>

                            <v-fade-transition mode="out-in">
                                <login-form></login-form>
                            </v-fade-transition>
                        </v-card-text>
                    </v-col>
                </v-row>

                <!-- <bubble-2 style="transform: rotate(180deg) translate(-200px, -15%)"></bubble-2> -->
                <div class="d-none d-md-block">
                    <img
                        :src="require('@/components/Illustration/bubbles2.png')"
                        style="
                            position: absolute;
                            right: 0;
                            bottom: 0;
                            width: 300px;
                        "
                    />
                </div>
            </v-col>
        </v-row>
    </section>
</template>

<script>
import LoginForm from "./cards/LoginForm";

export default {
    components: {
        LoginForm,
    },
};
</script>
