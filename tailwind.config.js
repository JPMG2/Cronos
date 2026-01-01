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
        // Modal alert colors
        'bg-red-100',
        'text-red-600',
        'bg-orange-200',
        'text-orange-700',
        'bg-green-300',
        'text-green-800',
        {
            pattern: /w-(4|8|12|16|20|24|28|32|36|40|44|48|52|56|60|64)/,
        },
    ],

    theme: {
        extend: {
            colors: {
                // Paleta principal médica profesional
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                    DEFAULT: '#0ea5e9',
                },
                // Colores legacy mantenidos para compatibilidad
                'primary-dark': '#0369a1',
                secondary: '#64748b',
                'secondary-dark': '#475569',
                // Colores médicos suaves
                medical: {
                    success: '#86efac',
                    'success-light': '#f0fdf4',
                    warning: '#fde047',
                    'warning-light': '#fef3c7',
                    error: '#fca5a5',
                    'error-light': '#fee2e2',
                    info: '#93c5fd',
                    'info-light': '#dbeafe',
                },
                // Botones actualizados con colores suaves
                btn_danger: '#f87171',
                shw_danger: '#fecaca',
                btn_succes: '#4ade80',
                shw_succes: '#bbf7d0',
                shw_cerrar: '#fbbf24',
                ok_color: '#86efac',
                bad_color: '#fca5a5',
                warning_color: '#fde047',
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
