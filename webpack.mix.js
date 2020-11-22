const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
require("laravel-mix-purgecss");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    watchOptions: { ignored: ["node_modules", "vendor"] }
});

mix.js("resources/js/app.js", "public/js").version();

mix.sass("resources/sass/app.scss", "public/css").version();

mix.options({
    processCssUrls: false,
    postCss: [tailwindcss("tailwind.config.js")]
});
