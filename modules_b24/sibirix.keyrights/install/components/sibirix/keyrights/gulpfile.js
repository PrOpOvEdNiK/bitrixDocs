var browserify = require('browserify');
var gulp       = require('gulp');
var source     = require('vinyl-source-stream');
var gaze       = require('gaze');
var reload     = require('gulp-livereload');
var less       = require('gulp-less')
var babelify   = require('babelify');
var prefix     = require('gulp-autoprefixer');
var notify     = require('gulp-notify');
var minifycss  = require('gulp-minify-css');
var envify     = require('envify');

gulp.task('browserify', function() {
    var b = browserify();

    b.transform(envify, {'global': true, '_': 'purge', NODE_ENV: 'development'});
    b.transform(babelify, {presets: ['es2015', 'react']});
    //b.transform({global: true}, 'uglifyify');
    b.add('./static/js/application.js');
    return b.bundle()
        .on('error', notify.onError(function(err) {
            return err.toString()
        }))
        .pipe(source('bundle.js'))
        .pipe(gulp.dest('./static/js/'))
        //.pipe(reload())
});

gulp.task('less', function() {
    gulp.src('./static/css/style.less')
        .on('error', notify.onError(function(err) {
            return err.toString()
        }))
        .pipe(less())
        .pipe(prefix('last 3 versions'))
        .pipe(minifycss())
        .pipe(gulp.dest('./static/css'))
        .pipe(reload());
});

gulp.task('watch', ['less','browserify'], function() {
    gaze(['static/js/**/*.js', '!static/js/bundle.js'], function() {
        this.on('added', function() {
            gulp.start('browserify');
        });
        this.on('changed', function() {
            gulp.start('browserify');
        })
    });

    gaze('static/css/**/*.less', function() {
        this.on('added', function() {
            gulp.start('less');
        });
        this.on('changed', function() {
            gulp.start('less');
        })
    });

    reload.listen();
});

gulp.task('default', ['watch']);
