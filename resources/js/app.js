import "./bootstrap";

import { createApp } from "vue/dist/vue.esm-bundler";

import store from "@/store";
import App from "./App.vue";
import router from "@/plugins/router.js";
import vuetify from "@/plugins/vuetify.js";
import "@/plugins/vee-validate.js";
import i18n from "@/plugins/i18n.js";
import globalComponents from "@/global/components.js";
import { createPinia } from "pinia";

const app = createApp(App)
    .use(i18n)
    .use(vuetify)
    .use(router)
    .use(store)
    .use(createPinia())
    .use(globalComponents)
    .mount("#app");
