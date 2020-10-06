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

// mix.webpackConfig({
//     output: {
//         filename:'js/[name].js',
//         chunkFilename: 'js/chunks/[name].js',
//     },
// });

mix.sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .extract(['jquery', 'popper.js', 'bootstrap', 'axios', 'toastr', 'smooth-scrollbar', 'lozad'])
    .sourceMaps();


