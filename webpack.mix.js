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

// Este es el anterior que tenia
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

// mix.styles([
//     'resources/plantilla/css/nucleo/css/nucleo.css',
//     'resources/plantilla/css/@fortawesome/fontawesome-free/css/all.min.css',
//     'resources/plantilla/css/argon.css'
// ], 'public/css/plantilla.css')
// .scripts([
//     'resources/plantilla/js/jquery/dist/jquery.min.js',
//     'resources/plantilla/js/bootstrap/dist/js/bootstrap.bundle.min.js',
//     'resources/plantilla/js/js-cookie/js.cookie.js',
//     'resources/plantilla/js/jquery.scrollbar/jquery.scrollbar.min.js',
//     'resources/plantilla/js/jquery-scroll-lock/dist/jquery-scrollLock.min.js',
//     'resources/plantilla/js/chart.js/dist/Chart.min.js',
//     'resources/plantilla/js/chart.js/dist/Chart.extension.js',
//     'resources/plantilla/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
//     'resources/plantilla/js/argon.js',
//     'resources/plantilla/js/components/init/navbar.js'
// ], 'public/js/plantilla.js')
// .js(['resources/js/app.js'], 'public/js/app.js');
