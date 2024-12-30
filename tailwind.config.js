import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                blueSky: '#ACCCF1',
                blueDoff: '#308DFA',
                softYellow: '#E8F298',
                orange: '#E07B04',
              },
              backgroundImage: {
                'custom-bg': "url({{ asset('img/bg_home.png') }})",
              },
        },
    },
    plugins: [],
};
