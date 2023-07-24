import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/admin/app.scss',
                'resources/js/app.js',
                'resources/js/counter.js',
                'resources/js/admin/app.js',
                'resources/js/payment/paypal.js',
                'resources/fonts/admin/nucleo.eot',
                'resources/fonts/admin/nucleo.ttf',
                'resources/fonts/admin/nucleo.woff',
                'resources/fonts/admin/nucleo.woff2',
                'resources/fonts/admin/nucleo-icons.eot',
                'resources/fonts/admin/nucleo-icons.svg',
                'resources/fonts/admin/nucleo-icons.ttf',
                'resources/fonts/admin/nucleo-icons.woff',
                'resources/fonts/admin/nucleo-icons.woff2',
            ],
            refresh: true,
        }),
    ],
});
