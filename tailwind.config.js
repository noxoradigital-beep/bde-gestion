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
                bde: {
                    orange: '#F7521C',
                    corail: '#EF3A2F',
                    rose: '#E52947',
                    fuchsia: '#D51F5E',
                    violet: '#4F116F',
                    creme: '#FCDDA9',
                },
            },
        },
    },

    plugins: [forms],
};
