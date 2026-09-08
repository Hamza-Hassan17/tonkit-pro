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
                sans: ['Poppins', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    // "orange" key kept for compatibility — now CapBeast Golden Bronze
                    orange: '#c6963b',
                    'orange-dark': '#a87c2c',
                    gold: '#c6963b',
                    dark: '#090809',       // CapBeast Black
                    darker: '#050404',
                    gray: '#fafafa',       // Bright Snow
                },
            },
            maxWidth: {
                site: '1240px',
            },
        },
    },

    plugins: [forms],
};
