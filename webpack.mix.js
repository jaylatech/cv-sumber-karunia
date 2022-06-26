const mix = require("laravel-mix");

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

mix.browserSync({
    proxy: process.env.MIX_SENTRY_DSN_PUBLIC,
});

mix.disableNotifications();

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .css("resources/css/app.css", "public/css")
    .sourceMaps();

mix.css("resources/css/welcome.css", "public/css")
    .css("resources/css/partials/navbar.css", "public/css")
    .css("resources/css/partials/footer.css", "public/css")
    .css("resources/css/dashboard/dashboard.css", "public/css")
    .css("resources/css/partials/header.css", "public/css")
    .css("resources/css/partials/menu.css", "public/css")
    .css("resources/css/profil.css", "public/css")
    .sourceMaps();
