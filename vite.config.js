import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                 'resources/css/login.css',
                 'resources/css/dashboard.css',
                 'resources/css/dashboard2.css',
                 'resources/css/app.css',
                 'resources/js/app.js'
                ],
            refresh: true,
        }),
    ],
});
