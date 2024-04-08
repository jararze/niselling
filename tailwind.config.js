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
            fontSize: {
                'xss': '0.625rem', // Equivalent to 10px
                '2xs': '0.5rem',  // Equivalent to 8px
                '3xs': '0.375rem' // Equivalent to 6px
            },
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

    variants: {
        extend: {
            display: ['group-hover'],
        },
    },

    plugins: [
        forms,
        function ({ addVariant }) {
            addVariant('important', ({ container }) => {
                container.walkRules(rule => {
                    rule.selector = `.\\!${rule.selector.slice(1)}`;
                    rule.walkDecls(decl => {
                        decl.important = true;
                    });
                });
            });
        }
    ],
};
