const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.options({
    purifyCss: true
});

mix.styles([
    'public/admin/css/jquery.dataTables.css',
    'public/admin/css/select2.min.css',
], 'public/css/admin.css')
    .purgeCss({
        enabled: mix.inProduction(),
        folders: ['resources'],
        extensions: ['php', 'js', 'css'],
    })
    .version();

mix.styles([
    'public/movie/css/bootstrap.css',
    'public/movie/css/font-awesome.css',
    'public/movie/css/magnific-popup.css',
    'public/movie/css/movie.css',
    'public/movie/css/responsive.css',
], 'public/css/main.css')
    .purgeCss({
        enabled: mix.inProduction(),
        folders: ['resources'],
        extensions: ['php', 'js', 'css'],
    })
    .version();

mix.js('resources/js/admin.js', 'public/js/admin.js')
    .version();

mix.js([
    'resources/js/main.js',
    'public/movie/js/popper.js',
    'public/movie/js/bootstrap.js',
    'public/movie/js/jquery.magnific-popup.js',
], 'public/js/main.js')
    .version();
