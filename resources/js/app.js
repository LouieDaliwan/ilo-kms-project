import './bootstrap';
// import '../css/app.css';
import '../sass/app.scss';


// import {createApp} from 'vue'
import { createApp } from 'vue/dist/vue.esm-bundler';

import App from './App.vue'

import router from '@/plugins/router.js';
import vuetify from '@/plugins/vuetify.js';
import i18n from '@/plugins/i18n.js';

import { createPinia } from 'pinia'

const pinia = createPinia()

createApp(App)
.use(i18n)
.use(vuetify)
.use(router)
.use(pinia)
.mount("#app")



