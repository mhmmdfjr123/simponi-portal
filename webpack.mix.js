const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | MixConfig Asset Management
 |--------------------------------------------------------------------------
 |
 | MixConfig provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 | Author: Efriandika Pratama <efriandika.pratama@bni.co.id>
 |
 */

const resourcesPath = 'resources/assets/';
const frontThemePath = 'public/theme/front/';

let addFilesToVersioning = [];

// Compile less file (from resources) to css
mix.less(resourcesPath + 'less/simponi.less', frontThemePath + 'css', {relativeUrls:false})
    .less(resourcesPath + 'less/tinymce.less', frontThemePath + 'css/tinymce.css', {relativeUrls:false});

// Copy and merge js files from resources
mix.combine([resourcesPath + 'js/global/simponi.js'], frontThemePath + 'js/global/simponi.js');
mix.combine([resourcesPath + 'js/pages/customer.js'], frontThemePath + 'js/pages/customer.js');
mix.combine([
    resourcesPath + 'js/pages/simulation.js',
    resourcesPath + 'js/pages/simulation-validator.js',
], frontThemePath + 'js/pages/simulation.js');

// Copy and Combine Global Vendor
mix.combine([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/jquery.easing/jquery.easing.min.js',
    'node_modules/scrollreveal/dist/scrollreveal.min.js'
], frontThemePath + 'js/global/vendor.js');

// Copy vendor files
mix.copy('node_modules/bootstrap/dist/css/*.min.css', frontThemePath + 'vendor/bootstrap/css')
    .copy('node_modules/bootstrap/dist/js/*.min.js', frontThemePath + 'vendor/bootstrap/js')
    .copy('node_modules/bootstrap/dist/fonts/**', frontThemePath + 'vendor/bootstrap/fonts')
    .copy('node_modules/chart.js/dist/*.js', frontThemePath + 'vendor/chartjs')
    .copy('node_modules/font-awesome/css/*.min.css', frontThemePath + 'vendor/font-awesome/css')
    .copy('node_modules/font-awesome/fonts/**', frontThemePath + 'vendor/font-awesome/fonts')
    .copy('node_modules/jquery.animate-number/jquery.animateNumber.min.js', frontThemePath + 'vendor/jquery-animate-number')
    .copy('node_modules/jquery-numeric/*.js', frontThemePath + 'vendor/jquery-numeric')
    .copy('node_modules/jquery-touch-events/src/**.js', frontThemePath + 'vendor/jquery-touch-events')
    .copy('node_modules/scrolltofixed/*.js', frontThemePath + 'vendor/scrolltofixed');

addFilesToVersioning = addFilesToVersioning.concat([
    frontThemePath + 'vendor/bootstrap/css/bootstrap.min.css',
    frontThemePath + 'vendor/bootstrap/js/bootstrap.min.js',
    frontThemePath + 'vendor/font-awesome/css/font-awesome.min.css'
]);

if (mix.config.inProduction) {
    mix.version(addFilesToVersioning);
} else {
    mix.sourceMaps();
}