import mix from 'laravel-mix';

mix

.js('resources/js/app.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.less('resources/sass/bootstrap.less', 'public/css');