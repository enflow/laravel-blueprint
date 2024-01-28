const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './app/**/*.php',
        './resources/**/*.js',
        './resources/views/**/*.twig',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#ccc'
            }
        },
        fontFamily: {
            sans: ['Inter var', ...defaultTheme.fontFamily.sans],
        }
    },

    plugins: [
        require('@tailwindcss/forms'),
    ]
};
