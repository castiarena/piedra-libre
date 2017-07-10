var gulp = require('gulp'),
    fs = require('fs'),
    sass = require('gulp-sass'),
    autoPrefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps');


gulp.task('build',function(){
    gulp.start('css:build');
    gulp.start('assets:build');
    gulp.start('js:build');
});

gulp.task('js:build',function(){
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

gulp.task('assets:build',function(){
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

gulp.task('css:build',function(){
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
    gulp.watch('./src/img/**/*',['assets:build']);
    gulp.watch('./src/sass/**/*',['css:build']);
    gulp.watch('./src/js/**/*',['js:build']);
});

