import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
