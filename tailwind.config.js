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
            width: {
                '80': '20rem',
            },
            transitionTimingFunction: {
                'custom': 'cubic-bezier(.64,.04,.35,1)',
            },
            colors: {
                'nissan': '#c3002f',
            },
            fontFamily: {
                sans: ['nissan', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
