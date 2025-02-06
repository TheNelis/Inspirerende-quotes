import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/scss/all-styles.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Specificeer de output directory voor Vercel
        outDir: 'public/build',
        // Zorg dat assets in de root van de build directory komen
        assetsDir: '',
        // Genereer een manifest file voor Laravel
        manifest: true,
        rollupOptions: {
            output: {
                // Voorkom chunking voor eenvoudigere deployments
                manualChunks: undefined
            }
        }
    },
    // Zorg dat Vite weet waar de public directory is
    publicDir: 'public',
    // Base URL voor productie
    base: '/build/'
});