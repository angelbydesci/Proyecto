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
                 'resources/js/app.js',
                 'resources/css/valores.css',
                 'resources/css/pest.css',
                 'resources/js/pest.js',
                 'resources/css/objetivos.css',
                 'resources/js/dashboard.js',
                 'resources/css/autodiagnostico_porter.css',
                 'resources/js/autodiagnostico_porter.js',
                 'resources/css/autodiagnostico_cadena_de_valor.css',
                 'resources/js/autodiagnostico_cadena_de_valor.js',
                 'resources/css/autodiagnostico_bcg.css',
                 'resources/js/autodiagnostico_bcg.js',
                ],
            refresh: true,
        }),
    ],
});
