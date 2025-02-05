import defaultTheme from 'tailwindcss/defaultTheme';

const plugin = require("tailwindcss/plugin");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#1f4b8e",
                "primary-dark": "#102a52",
                secondary: "#182430",
                "secondary-dark": "#060C11",
                btn_danger: "#DC3545",
                shw_danger: "#E68C95",
                btn_succes: "#28A745",
                shw_succes: "#A6F7b8",
                shw_cerrar: "#ffa661",
                ok_color: "#53db85",
                bad_color: "#e0707a",
                warning_color: "#ffc15e",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                titles: ["Nunito"],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        plugin(function ({ addUtilities, theme }) {
            const newUtilities = {
                ".custom-scrollbar": {
                    ".custom-scrollbar::-webkit-scrollbar": { width: "6px" },
                    ".custom-scrollbar::-webkit-scrollbar-track": {
                        background: theme("bg-secondary"),
                    },
                    ".custom-scrollbar::-webkit-scrollbar-thumb": {
                        background: "#888",
                    },
                    ".custom-scrollbar::-webkit-scrollbar-thumb:hover": {
                        background: "#555",
                    },
                },
            };

            addUtilities(newUtilities, ["responsive", "hover"]);
        }),
    ],
};
