import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin/app.css',
                'resources/css/admin/individual/register.css',
                'resources/css/admin/individual/login.css',
                'resources/css/admin/individual/index.css',
                'resources/js/admin/app.js',
                'resources/css/app.css',
                'resources/css/individual/contacts/create.css',
                'resources/css/individual/contacts/confirm.css',
                'resources/css/individual/contacts/thanks.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    },
});
