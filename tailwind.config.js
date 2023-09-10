const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            animation: {
                blink: 'blink 1.4s infinite both',
            },
            keyframes: {
                blink: {
                    '0%': {
                        opacity: '0.2',
                    },
                    '20%': {
                        opacity: '1',
                    },
                    '100%': {
                        opacity: ' 0.2',
                    },
                },
            },
            fontFamily: {
                'sans': ['GE-Dinar', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.red,
                secondary: colors.green
            }
        },
    },

    plugins: [
        plugin(({ matchUtilities, theme }) => {
            matchUtilities(
                {
                    'animation-delay': (value) => {
                        return {
                            'animation-delay': value,
                        }
                    },
                },
                {
                    values: theme('transitionDelay'),
                }
            )
        })
    ],
}
