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
                    orange: '#f2682c',
                    'orange-dark': '#d9531b',
                    dark: '#16181d',
                    darker: '#0f1115',
                    gray: '#f4f4f5',
                },
            },
            maxWidth: {
                site: '1240px',
            },
        },
    },

    plugins: [forms],
};
