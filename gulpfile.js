var gulp = require('gulp');
var gulp_shell = require('gulp-shell');
var gulp_stylus = require('gulp-stylus');
var gulp_uncss = require('gulp-uncss');
var gulp_autoprefixer = require('gulp-autoprefixer');
var gulp_minify_css = require('gulp-minify-css');

gulp.task('default', ['build-templates','build-images','build-js','stylus']);

gulp.task('build-templates', gulp_shell.task([
	'php build.php'
]));

gulp.task('build-images', function() {
	gulp.src('images/**/*', {base: 'images'})
		.pipe(gulp.dest('_site/images', {mode: '0775'}));
});

gulp.task('build-js', function() {
	gulp.src('js/**/*', {base: 'js'})
		.pipe(gulp.dest('_site/js'));
});

gulp.task('stylus', function() {
	gulp.src('./styl/style.styl')
		.pipe(gulp_stylus({
			cache: false
		}))
		.pipe(gulp_autoprefixer())
		.pipe(gulp.dest('_site/css'));
});

gulp.task('optimize', function() {
	gulp.src('_site/css/*')
		.pipe(gulp_uncss({
			html: [
				'_site/index.html',
				'_site/south-nanaimo/index.html',
				'_site/north-nanaimo/index.html'
			],
			ignore: [
				/\.lg-jump-menu-.+/
			]
		}))
		.pipe(gulp_minify_css())
		.pipe(gulp.dest('_site/css'));
});

gulp.task('watch', function() {
	gulp.watch([
		'data/*',
		'templates/*',
		'*.php'
	], ['build-templates']);

	gulp.watch(['images/**/*'], ['build-images']);

	gulp.watch(['js/**/*'], ['build-js']);

	gulp.watch(['styl/**/*'], ['stylus']);
});