import {defineConfig} from 'vite';
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
                manualChunks(path) {
                    if (path.includes('node_modules')) {
                        return 'vendor';
                    }
                    if (path.includes('resources/js')) {
                        return 'app';
                    }
                    if (path.includes('resources/css')) {
                        return 'styles';
                    }

                }
            }
        }
    }
});
