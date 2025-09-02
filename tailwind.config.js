import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const { addDynamicIconSelectors } = require("@iconify/tailwind");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'marquee-x': {
                '0%':   { transform: 'translateX(0)' },
                '100%': { transform: 'translateX(-50%)' } // geser setengah karena kita gandakan konten
                },
                'marquee-y': {
                '0%':   { transform: 'translateY(0)' },
                '100%': { transform: 'translateY(-50%)' }
                }
            },
            animation: {
                // Durasi bisa diubah dengan CSS variable --marquee-duration (default 20s)
                'marquee-x': 'marquee-x var(--marquee-duration, 20s) linear infinite',
                'marquee-y': 'marquee-y var(--marquee-duration, 20s) linear infinite',
            },
        },
    },

    plugins: [forms,addDynamicIconSelectors(),require('tailwindcss-animated')],
};
