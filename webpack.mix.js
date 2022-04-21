const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/img', 'public/img')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .version();
