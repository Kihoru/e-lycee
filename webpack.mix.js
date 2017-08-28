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

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/utils/jquery.min.js')
   .copy('node_modules/materialize-css/dist/js/materialize.min.js', 'public/js/utils/materialize.min.js')
   .copy('node_modules/materialize-css/dist/css/materialize.min.css', 'public/css/utils/materialize.min.css')
   .copy('node_modules/materialize-css/dist/fonts', 'public/css/fonts')
   .copy('node_modules/satellizer/dist/satellizer.min.js', 'public/js/utils/satellizer.min.js')
   .copy('node_modules/angular/angular.min.js', 'public/js/utils/angular.min.js')
   .copy('node_modules/angular-resource/angular-resource.min.js', 'public/js/utils/angular-resource.min.js')
   .copy('node_modules/angular-route/angular-route.min.js', 'public/js/utils/angular-route.min.js')
   .copy('node_modules/oclazyload/dist/ocLazyLoad.min.js', 'public/js/utils/ocLazyLoad.min.js')
   .copy('node_modules/toastr/build/toastr.min.js', 'public/js/utils/toastr.min.js')
   .copy('node_modules/toastr/build/toastr.min.css', 'public/css/utils/toastr.min.css')
   .less('resources/assets/less/style.less', 'public/css/front.css');
