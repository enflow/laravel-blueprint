const mix = require('laravel-mix');

require('laravel-mix-purgecss');

mix.version()
    .disableSuccessNotifications()
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .copy('resources/img', 'public/img')
    .options({
        postCss: [
            require('postcss-easy-import')(),
            require('tailwindcss')('./tailwind.js'),
            require('postcss-preset-env')()
        ],
        processCssUrls: false,
    })
    .purgeCss({
        only: ['css/app.css'],
        extensions: ['html', 'js', 'jsx', 'twig', 'ts', 'tsx', 'php', 'vue'],
        whitelistPatterns: [],
        extractorPattern: '/[\\w-/.:]+(?<!:)/g'
    })
    .sourceMaps()
    .browserSync({
        files: [
            './resources/views/**/*.twig',
        ],
        https: {
            key: "/etc/dev-ssl/key.pem",
            cert: "/etc/dev-ssl/cert.pem"
        },
        proxy: 'urenstaat.enflow.test',
        notify: false,
        logSnippet: false,
        online: false,
        open: false
    });
