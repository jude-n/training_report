/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: '#fff',
      black: '#000',
      primary: {
        DEFAULT: '#132b4c',
        '80': '#004C97',
      },
      red: {
        '120': defaultTheme.colors.red['700'],
        DEFAULT: defaultTheme.colors.red['500'],
        '80': defaultTheme.colors.red['400'],
        '60': defaultTheme.colors.red['300'],
        '40': defaultTheme.colors.red['200'],
        '20': defaultTheme.colors.red['100'],
      },
    },
  },
  plugins: [],
}

