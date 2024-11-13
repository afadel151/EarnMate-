import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'home-bg': "url('/imgs/home-bg.png')",
                'footer-bg': "url('/imgs/footer-bg.png')",
                'home2-bg': "url('/imgs/achievements-bg.png')",
            },
            boxShadow: {
                'custom-purple': '0px 0px 40px 0px rgba(136, 4, 255, 0.36)',
            }
        },
    },

    plugins: [forms],
};
