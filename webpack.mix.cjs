// const mix = require('laravel-mix');
const mix= require('laravel-mix');

mix.copyDirectory('resources/images', 'public/images');
mix.js('resources/js/app.js', 'public/js');
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
