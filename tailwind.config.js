import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
            colors: {
                primary: {
                    50: '#fdf2f2',
                    100: '#fbe0e0',
                    200: '#f5b8b8',
                    300: '#e88585',
                    400: '#d34f4f',
                    500: '#ab1f1f',
                    600: '#8b0000',
                    700: '#700000',
                    800: '#560000',
                    900: '#3d0000',
                },
                secondary: {
                    50: '#fbf8f0',
                    100: '#f5edd6',
                    200: '#e9d7a4',
                    300: '#dcc072',
                    400: '#d1af4e',
                    500: '#c8a840',
                    600: '#a68731',
                    700: '#7d6626',
                    800: '#55451a',
                    900: '#33290f',
                },
            },
        },
    },

    plugins: [forms],
};
