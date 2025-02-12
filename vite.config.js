import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/views/themes/assets/sass/app.scss',
                'resources/views/themes/assets/js/app.js',
                'resources/views/themes/assets/js/main.js',
                'resources/views/themes/assets/scss/style.scss',
                'resources/views/themes/assets/css/style.css',
                'resources/views/themes/assets/css/app.css',
            ],
            refresh: true,
        }),
    ],
});
