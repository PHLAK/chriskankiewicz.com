const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            "resources/**/*.js",
            "resources/**/*.php",
            "resources/**/*.scss",
            "resources/**/*.vue"
        ],
        options: {
            whitelist: ['html', 'body', 'main', 'fab', 'fal'],
            whitelistPatterns: [/^fa\-/],
            whitelistPatternsChildren: [/^markdown/, /^token/]
        }
    },
    theme: {
        extend: {
            boxShadow: {
                "solid-gray-50": '4px 4px 0 #f8fafc',
                "solid-gray-100": '4px 4px 0 #f1f5f9',
                "solid-gray-200": '4px 4px 0 #e2e8f0',
                "solid-gray-300": '4px 4px 0 #cbd5e1',
                "solid-gray-400": '4px 4px 0 #94a3b8',
                "solid-gray-500": '4px 4px 0 #64748b',
                "solid-gray-600": '4px 4px 0 #475569',
                "solid-gray-700": '4px 4px 0 #334155',
                "solid-gray-800": '4px 4px 0 #1e293b',
                "solid-gray-900": '4px 4px 0 #0f172a'
            },
            colors: {
                gray: colors.blueGray,
                teal: colors.teal,
            },
            fontFamily: {
                lato: ['Lato', ...defaultTheme.fontFamily.sans],
                mono: ['Source Code Pro', ...defaultTheme.fontFamily.mono],
                montserrat: ['Montserrat', ...defaultTheme.fontFamily.sans],
                sans: ['Nunito', ...defaultTheme.fontFamily.sans]
            },
            inset: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem"
            },
            textColor: {
                github: "#171515",
                keybase: "#FF6F21",
                linkedin: "#2977C9", // #4875B4
                medium: "#1F1F1F",
                steam: "#3B3B38",
                twitter: "#1DA1F2"
            }
        },
        screens: {
            xs: "480px",
            sm: "640px",
            md: "800px",
            lg: "1024px",
            xl: "1280px"
        }
    },
    variants: {
        cursor: ["responsive", "hover", "focus"],
        textColor: ["group-hover"],
        textDecoration: ["responsive", "hover", "focus", "group-hover"]
    },
    plugins: []
};
