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
            // Couleurs officielles du BDE. Utilisables partout avec bg-bde-orange,
            // text-bde-violet, border-bde-rose, etc. (à la place des couleurs
            // par défaut de Tailwind comme indigo-500 ou red-600).
            colors: {
                bde: {
                    orange: '#F7521C',
                    corail: '#EF3A2F',
                    rose: '#E52947',
                    fuchsia: '#D52F5E',
                    violet: '#4F116F',
                    creme: '#FCDDA9',
                },
            },
        },
    },

    plugins: [forms],
};
