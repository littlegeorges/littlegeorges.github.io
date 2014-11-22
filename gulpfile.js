var gulp = require('gulp');
var gulp_shell = require('gulp-shell');

gulp.task('default', gulp_shell.task([
	'php build.php'
]));

gulp.task('watch', function() {
	gulp.watch([
		'data/*',
		'css/*',
		'js/*',
		'templates/*',
		'*.php'
	], ['default'])
});