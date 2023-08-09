import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import * as labsComponents from "vuetify/labs/components";

import "@mdi/font/css/materialdesignicons.css";

export default createVuetify({
    ssr: true,
    components,
    directives,
    labsComponents,
    rtl: false,
    icons: {
        defaultSet: "mdi",
    },
    theme: {
        options: {
            minifyThem: function (css) {
                return process.env.NODE_ENV === "production"
                    ? css.replace(/[\r\n|\r\n]/g, "")
                    : css;
            },
        },
        // themes: {
        // light: theme.colors.light,
        // dark: theme.colors.dark,
        // },
        defaultTheme: "light",
    },
});
