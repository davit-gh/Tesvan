const mix = require('laravel-mix');

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

mix.combine(['public/css/bootstrapCss/bootstrap.css','public/css/style.css','public/css/header.css','public/css/banner.css','public/css/footer.css'], 'public/merged.css');
mix.combine(['public/js/lozad.min.js', 'public/js/bootstrap/bootstrap.js','public/js/custom.js'], 'public/merged.js');
