
'use strict';
 
var gulp = require('gulp'),
sourcemaps = require('gulp-sourcemaps'),
sass = require('gulp-sass'),
rjs = require('gulp-requirejs'),
shell = require('gulp-shell'),
runSequence = require('run-sequence'),
copy = require('gulp-copy');
 
gulp.task('sass', function () {
    
gulp.src('./web/bundles/app/scss/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass({sourceComments: 'map'}))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./web/css'));

});

gulp.task('fonts', function () {
    return gulp.src('./web/bundles/resume/js/thirdparty/bootstrap-sass-official/assets/fonts/bootstrap/*')
        .pipe(copy('./web/', {prefix: 7}));
});

gulp.task('js', function() {
    gulp.src('./web/bundles/app/js/**/**/*.js')
        .pipe(gulp.dest('./web/js'));
});

gulp.task('assets', shell.task([
  'php app/console assets:install web'
]));

gulp.task('frontend', function() {
	runSequence(
		'assets', 
		['js', 'fonts', 'sass'] // ...then do these things in parallel
	);
});