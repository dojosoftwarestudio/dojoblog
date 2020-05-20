const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
mix.styles([
	'resources/css/fs.css',
	'resources/css/sb-admin-2.css',
	'resources/css/dojoblog.css',
	],'public/css/all.css')
