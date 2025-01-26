const mix = require("laravel-mix");
const path = require("path");

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

mix.js("resources/js/app.js", "public/js")
    .vue()
    .js("resources/js/app.v2.js", "public/js")
    .js("resources/js/app-admin.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/app.v2.scss", "public/css")
    .sass("resources/sass/app-admin.scss", "public/css")
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve("resources/js"),
            },
            fallback: {
                crypto: false,
            },
        },
    })
    .version()
    .sourceMaps();
