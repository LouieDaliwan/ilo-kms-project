import "./bootstrap";
import "../css/app.scss";

// import Vue from 'vue'
import { createApp } from "vue/dist/vue.esm-bundler";

import App from "./App.vue";

import router from "@/plugins/router.js";
import vuetify from "@/plugins/vuetify.js";
import "@/plugins/vee-validate.js";
import i18n from "@/plugins/i18n.js";

import { createPinia } from "pinia";

const pinia = createPinia();

const app = createApp(App)
    .use(i18n)
    .use(vuetify)
    .use(router)
    .use(pinia)
    .mount("#app");
