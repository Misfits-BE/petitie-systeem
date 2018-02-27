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

mix // Laravel mix instance

    // Global application JS and Stylesheets
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
   
    // Bootstrap markdown (used for the comment sections)
    .js('node_modules/bootstrap-markdown/js/bootstrap-markdown.js', 'public/js') 
    .copy('node_modules/bootstrap-markdown/css/bootstrap-markdown.min.css', 'public/css');
