var gulp = require('gulp');
var gulp_shell = require('gulp-shell');
var gulp_stylus = require('gulp-stylus');

gulp.task('default', gulp_shell.task([
	'php build.php'
]));

gulp.task('stylus', function() {
	gulp.src('./styl/style.styl')
		.pipe(gulp_stylus({
			compress: true,
			cache: false
		}))
		.pipe(gulp.dest('_site/css'));
});

gulp.task('watch', function() {
	gulp.watch([
		'data/*',
		'js/*',
		'templates/*',
		'*.php'
	], ['default']);

	gulp.watch(['styl/*'],['stylus'])
});