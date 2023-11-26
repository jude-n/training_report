/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            backgroundImage: theme => ({
                'your-image': "url('/images/background-2.png')"
            }),
            backgroundPosition: {
                'center-fixed': 'center center fixed',
            },
        },
        backgroundRepeat: {
            'repeat-x': 'repeat-x',
        },
        backgroundSize: {
            'cover': 'cover',
        },
    colors: {
        transparent: 'transparent',
        current: 'currentColor',
        white: '#fff',
        black: '#000',
        primary: {
            DEFAULT: '#132b4c',
            '80': '#002857d4',
            '70': '#004C97',
        },
        red: {
            DEFAULT: '#991b1b',
            '80': '#b91c1c',
            '60': '#dc2626',
            '40': '#ef4444',
            '20': '#f87171',
            '10': '#fca5a5',

        },
        green: {
            DEFAULT: '#059669',
            '80': '#10b981',
            '60': '#34d399',
            '40': '#6ee7b7',
            '20': '#a7f3d0',
            '10': '#bef5cb',
        },
        orange: {
            DEFAULT: '#FF4500',

        },
    },
}
,
plugins: [],
}

