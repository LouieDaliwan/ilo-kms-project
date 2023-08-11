import { fileURLToPath, URL } from "url";
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import VueI18nPlugin from "@intlify/unplugin-vue-i18n/vite";
import vue from "@vitejs/plugin-vue";
import path from "path";
import sass from "sass";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        VueI18nPlugin({
            include: [
                path.resolve(__dirname, "./resources/js/src/lang/*.json"),
            ],
        }),
        sass,
    ],
    resolve: {
        alias: [
            {
                find: "@root",
                replacement: fileURLToPath(
                    new URL("./resources/js/", import.meta.url),
                ),
            },
            {
                find: "@",
                replacement: fileURLToPath(
                    new URL("./resources/js/src", import.meta.url),
                ),
            },
            {
                find: "@js",
                replacement: fileURLToPath(
                    new URL("./resources/js", import.meta.url),
                ),
            },
            {
                find: "@modules",
                replacement: fileURLToPath(
                    new URL("./resources/js/src/modules", import.meta.url),
                ),
            },
            {
                find: "@components",
                replacement: fileURLToPath(
                    new URL("./resources/js/src/Components", import.meta.url),
                ),
            },
        ],
    },
    configureWebpack: {
        module: {
            rules: {
                test: /\.sass$/,
                loaders: ["style", "css", "scss"],
            },
        },
    },
});
