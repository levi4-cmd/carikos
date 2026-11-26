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
            colors: {
                gray: {
                    50: '#F8FAFC',
                    100: '#F8FAFC',
                    300: '#CBD5E1',
                    500: '#64748B',
                    600: '#334155',
                    700: '#334155',
                    800: '#1E293B',
                    900: '#0F172A',
                },
                indigo: {
                    50: '#EFF6FF',
                    100: '#DBEAFE',
                    400: '#3B82F6',
                    500: '#3B82F6',
                    700: '#1D4ED8',
                    800: '#1E40AF',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
