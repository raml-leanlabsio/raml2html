var gulp = require('gulp');
var bower = require('gulp-bower');
var sass = require('gulp-sass');

gulp.task('bower', function() {
    return bower()
        .pipe(gulp.dest('./bower_components'));
});

gulp.task('sass', function () {
    gulp.src('./src/scss/*.scss')
        .pipe(sass({
            style: 'compressed',
            includePath: [
                './bower_components/foundation/scss/foundation'
            ]
        }))
        .pipe(gulp.dest('./web/assets/css/'));
});

gulp.task('copy', function() {
    gulp.src('./src/index.html')
        .pipe(gulp.dest('./web/'));

});

gulp.task('watch', function() {
    gulp.watch('./src/**/*.html', ['copy']);
    gulp.watch('./src/**/*.js', ['copy']);
    gulp.watch('./src/**/*.scss', ['sass']);
});

gulp.task('default', ['bower', 'copy', 'watch', 'sass']);
