/** @type {import('tailwindcss').Config} */
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
        DEFAULT: '#991b1b',
        '80': '#b91c1c',
        '60': '#dc2626',
        '40': '#ef4444',
        '20': '#f87171',
        '10': '#fca5a5',

      },
    },
  },
  plugins: [],
}

