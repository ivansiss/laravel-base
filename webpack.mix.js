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
/*
mix.js('donde termina compilando', 'public/js')
mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css')
        .sass('resources/sass/menusup.scss', 'public/css')
        .sass('resources/sass/menu_lateral_admin.scss', 'public/css');
*/ 

mix.styles('resources/sass/mi_plantilla.scss','public/css/mi_plantilla.css');
mix.styles([
        'resources/vendor/css/adminlte/adminlte.min.css',
        'resources/sass/app.scss',
],'public/css/plantilla.css')
.js('resources/js/app.js', 'public/js')
.scripts([
        'resources/vendor/js/adminlte/adminlte.min.js',
        'resources/vendor/js/demo.js',
        'resources/vendor/js/bs-custom-file-input/bs-custom-file-input.min.js',
], 'public/js/plantilla.js')
.copy('resources/vendor/img', 'public/img');







