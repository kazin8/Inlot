'use strict';

import elixir from 'laravel-elixir';
import gulp from 'gulp';
import less from 'gulp-less';
import autoprefixer from 'gulp-autoprefixer';
import minifycss from 'gulp-minify-css';
import rename from 'gulp-rename';
import notify from 'gulp-notify';
import uglify from 'gulp-uglify';
import browserify from 'browserify';

elixir.extend('style' ,() => {
	new elixir.Task('style', () => {
		return gulp.src('resources/assets/less/*.less')
		.pipe(less())
		.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(minifycss())
		.pipe(gulp.dest('public/assets/'))
		.pipe(notify({
			message: 'css!'
		}));
	}).watch('resources/assets/less/*.less');
});

elixir((mix) => {
	mix.browserify('resources/assets/js/my/app.js','public/assets/');
	mix.style();
	mix.browserSync({
		proxy: 'inlot.dev'
	});
});
