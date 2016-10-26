
var gulp = require('gulp'),
  connect = require('gulp-connect');
 
gulp.task('webserver', function() {
  connect.server({
   livereload:true
   });
});
 

gulp.task('watch', function() {
    gulp.watch('src/**/*.html');
})

gulp.task('default', ['webserver', 'watch']);
