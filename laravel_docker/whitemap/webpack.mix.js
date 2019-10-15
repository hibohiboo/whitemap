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

mix.ts('resources/ts/common/app.ts', 'public/js/common')
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.ts('resources/ts/welcome/index.ts', 'public/js/welcome').version();
mix.ts('resources/ts/home/index.ts', 'public/js/home').version();
mix.ts('resources/ts/login/index.ts', 'public/js/login').version();
mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
        firebase: 'firebase',
        firebaseui: 'firebaseui',
        axios: 'axios',
        lodash: 'lodash',
        bootstrap: 'bootstrap',
        popper: 'popper.js'
    }
});
