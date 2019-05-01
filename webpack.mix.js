const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version()
    .browserSync({
        https: {
            key: "/etc/dev-ssl/key.pem",
            cert: "/etc/dev-ssl/cert.pem"
        },
        proxy: 'callrondes.client.test',
        notify: false,
        logSnippet: false,
        online: false,
        open: false,
        port: 3100,
        ui: {
            port: 3101
        }
    });
