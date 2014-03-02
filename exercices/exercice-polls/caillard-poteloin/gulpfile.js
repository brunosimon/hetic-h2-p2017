var gulp       = require('gulp');
var server     = require('tiny-lr')();
var livereload = require('gulp-livereload');
var less       = require('gulp-less');
var csslint    = require('gulp-csslint');
var jshint     = require('gulp-jshint');
var ftp        = require('gulp-ftp');

var co = {
  host: '****',
  user: '****',
  pass: '****',
  port: '****',
  remotePath: '****'
}

gulp.task('less', function () {
  gulp.src('assets/less/style.less')
    .pipe(less({
      sourceMap: true
    }))
    .pipe(gulp.dest('assets/css/'));
});

gulp.task('css', function() {
  gulp.src('assets/css/style.css')
    .pipe(csslint({
      "unique-headings": false,
      "adjoining-classes": false,
      "compatible-vendor-prefixes": false,
      "qualified-headings": false,
      "box-model": false,
      "overqualified-elements": false,
      "font-sizes": false,
      "box-sizing": false,
      "universal-selector": false
    }))
    .pipe(csslint.reporter())
    .pipe(livereload(server));
});

gulp.task('php', function() {
  gulp.src(['./**/*.php', '!node_modules/**/*.php'])
    .pipe(livereload(server));
});

gulp.task('js', function() {
  gulp.src(['assets/js/**/*.js', '!assets/js/jquery-2.1.0.js'])
    .pipe(jshint())
    .pipe(jshint.reporter())
    .pipe(livereload(server));
});

gulp.task('upload', function() {
  gulp.src(['./**/*.php', '!node_modules/**/*.php', 'assets/js/**/*.js', '!assets/js/jquery-2.1.0.js', 'assets/css/style.css'])
    .pipe(ftp(co));
});

gulp.task('default', function(){
  server.listen(35729, function (err) {
    if (err) return console.log(err);
  });

  gulp.watch('assets/less/**/*.less', ['less']);
  gulp.watch('assets/css/style.css', ['css']);
  gulp.watch(['./**/*.php', '!node_modules/**/*.php'], ['php']);
  gulp.watch(['assets/js/**/*.js', '!assets/js/jquery-2.1.0.js'], ['js']);
});