var gulp = require('gulp'),
    fs = require('fs'),
    sass = require('gulp-sass'),
    autoPrefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps');


gulp.task('build',function(){
    gulp.start('build:css')
        .start('build:assets')
        .start('build:js')
        .start('build:downloads')
});

gulp.task('build:js',function(){
    gulp.src([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/handlebars/dist/handlebars.js',
        './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js'])
        .pipe(concat('dep.js'))
        .pipe(gulp.dest('../assets/js/'));

    gulp.src('./src/js/*.js' )
        .pipe(concat('site.js'))
        .pipe(gulp.dest('../assets/js/'));
});

gulp.task('build:assets',function(){
    fs.rmdir('./build/img',function(){
        gulp.src('./src/img/**/*')
            .pipe(gulp.dest('../assets/img/'));
    });

    fs.rmdir('./build/fonts',function(){
        gulp.src(['./src/fonts/**/*', './node_modules/font-awesome/fonts/fontawesome-webfont.*'])
            .pipe(gulp.dest('../assets/fonts'));
        gulp.src('./node_modules/font-awesome/scss/font-awesome.scss')
            .pipe(sass())
            .pipe(autoPrefixer())
            .pipe(gulp.dest('../assets/css/'))
    });

});

gulp.task('build:css',function(){
    gulp.src('./src/sass/styles.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('../assets/css'));
    gulp.src('./src/sass/icons.scss')
        .pipe(sass())
        .pipe(gulp.dest('../assets/css'));

    // Admin
    gulp.src('./src/sass/admin.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('../assets/css'));
});

gulp.task('watch' ,function(){
    gulp.start('build');
    gulp.watch('./src/img/**/*',['build:assets']);
    gulp.watch('./src/sass/**/*',['build:css']);
    gulp.watch('./src/js/**/*',['build:js']);
});

gulp.task('build:downloads', function(){
    gulp.src('./src/downloads/**/*')
        .pipe(gulp.dest('../assets/downloads'));
});