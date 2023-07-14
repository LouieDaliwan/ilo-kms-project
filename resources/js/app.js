import './bootstrap';
import '../css/app.css';


import {createApp} from 'vue'
import App from './App.vue'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import router from './router/routes';

const vuetify = createVuetify({
  components,
  directives,
})

createApp(App)
.use(vuetify)
.use(router)
.mount("#app")

