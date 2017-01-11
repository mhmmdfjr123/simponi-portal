const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

let frontThemePath = 'public/theme/front/';

elixir(mix => {
    // Compile less file to css
    mix.less('simponi.less', frontThemePath + 'css');

    // Copy and merge js files into single file (simponi.js)
    mix.scriptsIn('resources/assets/js', frontThemePath + 'js/simponi.js');

    // Copy vendor files
    mix.copy(['node_modules/bootstrap/dist/**/*', '!**/npm.js', '!**/bootstrap-theme.*', '!**/*.map'], frontThemePath + 'vendor/bootstrap');
    mix.copy(['node_modules/jquery/dist/jquery.js', 'node_modules/jquery/dist/jquery.min.js'], frontThemePath + 'vendor/jquery');
    mix.copy(['node_modules/magnific-popup/dist/**'], frontThemePath + 'vendor/magnific-popup');
    mix.copy(['node_modules/scrollreveal/dist/*.js'], frontThemePath + 'vendor/scrollreveal');
    mix.copy([
        'node_modules/font-awesome/**',
        '!node_modules/font-awesome/**/*.map',
        '!node_modules/font-awesome/.npmignore',
        '!node_modules/font-awesome/*.txt',
        '!node_modules/font-awesome/*.md',
        '!node_modules/font-awesome/*.json',
        '!node_modules/font-awesome/less',
        '!node_modules/font-awesome/scss'
    ], frontThemePath + 'vendor/font-awesome');
});
