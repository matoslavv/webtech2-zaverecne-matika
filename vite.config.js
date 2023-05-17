import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    root: 'public',
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true
    }
});
