import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import manifestSRI from 'vite-plugin-manifest-sri';
import fs from 'fs';

export default defineConfig(({mode}) => {
    const host = loadEnv(mode, process.cwd()).VITE_HOST;

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                ],
                refresh: true,
            }),
            manifestSRI(),
        ],
        server: {
            host,
            hmr: { host },
            https: fs.existsSync(`/etc/dev-ssl/key.pem`) && fs.existsSync(`/etc/dev-ssl/cert.pem`) ? {
                key: fs.readFileSync(`/etc/dev-ssl/key.pem`),
                cert: fs.readFileSync(`/etc/dev-ssl/cert.pem`),
            } : {},
        },
    }
});
