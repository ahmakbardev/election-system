//webpack.mix.js
const mix = require("laravel-mix");

mix.webpackConfig({})
    .browserSync({
        proxy: "localhost:8000",
        files: [
            "app/**/*.php",
            "resources/views/**/*.php",
            "public/js/**/*.js",
            "public/css/**/*.css",
        ],
    })
    .js("resources/js/app.js", "public/js")
    .js("resources/js/theme.js", "public/js/theme.js")
    .sourceMaps()
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")]);
