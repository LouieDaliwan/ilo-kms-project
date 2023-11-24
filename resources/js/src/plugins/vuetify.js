import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import * as labsComponents from "vuetify/lib/labs/components";

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
        defaultTheme: "light",
        themes: {
            light: {
                // dark: false,
                colors: {
                    "primary": "#1E2DBE",
                    "secondary": "#FA3C4B",
                    "accent": "#05D2D2",
                    "success": "#86d067",
                    "info": "#00b8d6",
                    "warning": "#F6C343",
                    "error": "#f44336",
                    "light": "#f8f9fa",
                    "dark": "#1e262b",
                    "text": "#230050",
                    "card": "#ffffff",
                    "sidebar": "#f7f7f7",
                    "workspace": "#f9fbfd",
                    "muted": "#95aac9",
                    "link": "#868e96",
                    "soft-success": "#ccf7e5",
                    "soft-error": "#fad7dd",
                    "soft-info": "#d7eff6",
                    "soft-warning": "#fdf3d9",
                    "selects": "#edf2f9",
                    "field": "#d2ddec",
                    "sheet": "ffffff"
                  }
              }
        }
    }

});



