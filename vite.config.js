import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import manifestSRI from 'vite-plugin-manifest-sri';
import fs from 'fs';

const host = 'laravel-blueprint.enflow.test';

export default defineConfig({
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
        https: {
            key: fs.readFileSync(`/etc/dev-ssl/key.pem`),
            cert: fs.readFileSync(`/etc/dev-ssl/cert.pem`),
        },
    },
});
