const mix = require('laravel-mix');

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                Popper: ['popper.js', 'default'],
            })
        ]
    };
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version()
    .browserSync({
        https: {
            key: "/etc/dev-ssl/key.pem",
            cert: "/etc/dev-ssl/cert.pem"
        },
        proxy: 'laravel.enflow.test',
        notify: false,
        logSnippet: false,
        online: false,
        open: false,
        port: 3100,
        ui: {
            port: 3101
        }
    });
