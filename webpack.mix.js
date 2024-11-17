const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue()  // This tells Mix to process Vue files
   .sass('resources/sass/app.scss', 'public/css'); // Optional: if you use Sass for your CSS
