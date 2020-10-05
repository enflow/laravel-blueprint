const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.twig',
    ],

    theme: {
        fontFamily: {
            sans: ['Nunito', ...defaultTheme.fontFamily.sans],
        }
    },

    future: {
        removeDeprecatedGapUtilities: true, // https://tailwindcss.com/docs/upcoming-changes#remove-deprecated-gap-utilities
        purgeLayersByDefault: true, // https://tailwindcss.com/docs/upcoming-changes#purge-layers-by-default
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')]
};
