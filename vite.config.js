import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
          plugins: [
            require('autoprefixer'),
            require('postcss-import'),
            require('tailwindcss'),
          ],
        },
    },
});
