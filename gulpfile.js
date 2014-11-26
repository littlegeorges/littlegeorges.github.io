var gulp = require('gulp');
var gulp_shell = require('gulp-shell');
var gulp_stylus = require('gulp-stylus');
var gulp_uncss = require('gulp-uncss');
var gulp_minify_css = require('gulp-minify-css');

gulp.task('default', ['php','stylus','optimize']);

gulp.task('php', gulp_shell.task([
	'php build.php'
]));

gulp.task('stylus', function() {
	gulp.src('./styl/style.styl')
		.pipe(gulp_stylus({
			cache: false
		}))
		.pipe(gulp.dest('_site/css'));
});

gulp.task('optimize', function() {
	gulp.src('_site/css/*')
		.pipe(gulp_uncss({
			html: [
				'_site/index.html',
				'_site/south-nanaimo/index.html',
				'_site/north-nanaimo/index.html'
			]
		}))
		.pipe(gulp_minify_css())
		.pipe(gulp.dest('_site/css'));
});

gulp.task('watch', function() {
	gulp.watch([
		'data/*',
		'js/*',
		'templates/*',
		'*.php'
	], ['php']);

	gulp.watch(['styl/*'],['stylus'])
});