import defaultTheme from 'tailwindcss/defaultTheme';

const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './app/Livewire/**/*.php',
    ],
    safelist: [
        'peer',
        'peer-placeholder-shown',
        'peer-focus',
        'peer-placeholder-shown:top-4',
        'peer-placeholder-shown:text-base',
        'peer-placeholder-shown:text-gray-400',
        'peer-focus:top-2',
        'peer-focus:text-sm',
        'peer-focus:text-blue-600',
        'w-32',
        'w-36',
        'w-28',
        'w-40',
        'w-56',
        'w-64',
        {
            pattern: /w-(4|8|12|16|20|24|28|32|36|40|44|48|52|56|60|64)/,
        },
    ],

    theme: {
        extend: {
            colors: {
                primary: '#1f4b8e',
                'primary-dark': '#102a52',
                secondary: '#182430',
                'secondary-dark': '#060C11',
                btn_danger: '#DC3545',
                shw_danger: '#E68C95',
                btn_succes: '#28A745',
                shw_succes: '#A6F7b8',
                shw_cerrar: '#ffa661',
                ok_color: '#53db85',
                bad_color: '#e0707a',
                warning_color: '#ffc15e',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                titles: ['Nunito'],
            },
            maxHeight: {
                75: '18.75rem',
                80: '20rem',
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        plugin(function ({ addUtilities, theme }) {
            const newUtilities = {
                '.custom-scrollbar': {
                    '.custom-scrollbar::-webkit-scrollbar': { width: '6px' },
                    '.custom-scrollbar::-webkit-scrollbar-track': {
                        background: theme('bg-secondary'),
                    },
                    '.custom-scrollbar::-webkit-scrollbar-thumb': {
                        background: '#888',
                    },
                    '.custom-scrollbar::-webkit-scrollbar-thumb:hover': {
                        background: '#555',
                    },
                },
            };

            addUtilities(newUtilities, ['responsive', 'hover']);
        }),
    ],
};
