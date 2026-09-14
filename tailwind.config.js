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
                body: ['Sora', ...defaultTheme.fontFamily.sans],
                display: ['"Bricolage Grotesque"', ...defaultTheme.fontFamily.sans],
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
                // Palette de la refonte "dark / cinéma" (site public + future app mobile)
                cf: {
                    bg: 'oklch(14% 0.012 55)',
                    surface: 'oklch(19% 0.014 55)',
                    'surface-2': 'oklch(24% 0.017 55)',
                    line: 'oklch(30% 0.016 55)',
                    ink: 'oklch(97% 0.006 60)',
                    muted: 'oklch(70% 0.02 60)',
                    faint: 'oklch(52% 0.018 60)',
                    gold: 'oklch(78% 0.15 82)',
                    'gold-strong': 'oklch(70% 0.16 78)',
                    'gold-ink': 'oklch(20% 0.03 75)',
                    ok: 'oklch(72% 0.15 148)',
                },
            },
        },
    },

    plugins: [forms],
};
