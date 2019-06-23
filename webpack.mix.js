/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
const mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources/assets',
            '@vue': __dirname + '/resources/assets/vue/src',
            '@config': __dirname + '/resources/assets/vue/config',
        }
    },
});

// noinspection JSUnresolvedFunction
mix.js('resources/assets/vue/main.js', 'public/js');
