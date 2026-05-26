import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['alpinejs'],
                },
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                // ✅ CSS uses assetFileNames (not cssEntryFileName)
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name?.endsWith('.css')) {
                        return 'assets/[name]-[hash][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                },
            },
        },
    },
});