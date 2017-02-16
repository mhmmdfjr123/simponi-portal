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

// Compile less file (from resources) to css
mix.less(resourcesPath + 'less/simponi.less', frontThemePath + 'css', {relativeUrls:false})
    .less(resourcesPath + 'less/tinymce.less', frontThemePath + 'css/tinymce.css', {relativeUrls:false});

// Copy and merge js files from resources
mix.combine([resourcesPath + 'js/simponi.js'], frontThemePath + 'js/simponi.js');
mix.combine([resourcesPath + 'js/pages/customer.js'], frontThemePath + 'js/pages/customer.js');
mix.combine([
    resourcesPath + 'js/pages/simulation.js',
    resourcesPath + 'js/pages/simulation-validator.js',
], frontThemePath + 'js/pages/simulation.js');

// Copy and Combine Global Vendor
mix.combine([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/jquery.easing/jquery.easing.min.js',
    'node_modules/jquery-validation/dist/jquery.validate.min.js',
    'node_modules/scrollreveal/dist/scrollreveal.min.js',
    'node_modules/toastr/build/toastr.min.js'
], frontThemePath + 'js/vendor.js');
mix.combine([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/ionicons/css/ionicons.min.css',
    'node_modules/toastr/build/toastr.min.css'
], frontThemePath + 'css/vendor.css');

// Copy vendor files for specific page
mix.copy('node_modules/bootstrap/dist/fonts/**', frontThemePath + 'fonts')
    .copy('node_modules/chart.js/dist/*.js', frontThemePath + 'vendor/chartjs')
    .copy('node_modules/font-awesome/fonts/**', frontThemePath + 'fonts')
    .copy('node_modules/ionicons/fonts/**', frontThemePath + 'fonts')
    .copy('node_modules/jquery.animate-number/jquery.animateNumber.min.js', frontThemePath + 'vendor/jquery-animate-number')
    .copy('node_modules/jquery-numeric/*.js', frontThemePath + 'vendor/jquery-numeric')
    .copy('node_modules/jquery-touch-events/src/**.js', frontThemePath + 'vendor/jquery-touch-events')
    .copy('node_modules/jquery-validation/dist/localization/**.js', frontThemePath + 'vendor/jquery-validation/localization')
    .copy('node_modules/scrolltofixed/*.js', frontThemePath + 'vendor/scrolltofixed');

if (mix.config.inProduction) {
    mix.version();
} else {
    mix.sourceMaps();
}