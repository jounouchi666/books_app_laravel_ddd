import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({ mode, command }) => {
    const env = loadEnv(mode, process.cwd(), '');

    const config = {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
    };

    if (command === 'serve') {
        config.server = {
            host: '0.0.0.0',
            hmr: {
                host: env.VITE_HMR_HOST || 'localhost',
                clientPort: 5173,
            },
            cors: true, 
        };
    }

    return config;
});