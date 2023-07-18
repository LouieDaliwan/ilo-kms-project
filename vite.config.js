import { fileURLToPath, URL } from "url";
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'


export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            { find: '@', replacement: fileURLToPath(new URL('./resources/js/src', import.meta.url)) },
            { find: '@js', replacement: fileURLToPath(new URL('./resources/js', import.meta.url)) },
            { find: '@modules', replacement: fileURLToPath(new URL('./resources/js/src/modules', import.meta.url)) },
            { find: '@components', replacement: fileURLToPath(new URL('./resources/js/src/Components', import.meta.url)) },
        ]
    }
});
