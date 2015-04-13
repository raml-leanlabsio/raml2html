var gulp = require('gulp');

gulp.task('generate', function(){

});

gulp.task('watch', function() {
    gulp.watch('./data/**/*.*', ['generate']);
});

gulp.task('default', ['generate', 'watch']);
