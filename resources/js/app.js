import './bootstrap';
// import '../css/app.css';
import '../sass/app.scss';


// import {createApp} from 'vue'
import { createApp } from 'vue/dist/vue.esm-bundler';

import App from './App.vue'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import router from '@/plugins/router.js';

import { createPinia } from 'pinia'

const vuetify = createVuetify({
  components,
  directives,
})

const pinia = createPinia()

createApp(App)
.use(vuetify)
.use(router)
.use(pinia)
.mount("#app")



