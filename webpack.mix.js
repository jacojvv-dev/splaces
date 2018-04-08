let mix = require('laravel-mix');

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

mix.js('resources/assets/js/vendor.js', 'public/js')
    .js('resources/assets/js/views/home/home.js', 'public/js')
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/venue.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/site.scss', 'public/css')
    .version();
