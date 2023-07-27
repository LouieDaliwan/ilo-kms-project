import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import theme from '@root/theme.json';

export default createVuetify ({
    components,
    directives,
    rtl: false,
    icons: "mdi",
    theme: {
        options:{
            minifyThem: function(css) {
                return process.env.NODE_ENV === 'production' ?
                css.replace(/[\r\n|\r\n]/g, ""): css
            }
        },
        themes: {
            light: theme.colors.light,
            dark: theme.colors.dark,
        }
    },
})