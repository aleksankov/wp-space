import gulp from 'gulp';
import *as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import autoprefixer from 'gulp-autoprefixer';
import gcmq from 'gulp-group-css-media-queries';

gulp.task('sass-compile', function(done){
    gulp.src('assets/sass/**/*.scss')
        .pipe(sass({outputStyle: 'expanded', indentWidth: 4}).on('error', sass.logError))
        .pipe(autoprefixer({ cascade: true }))
        .pipe(gcmq())
        .pipe(gulp.dest('assets/css'));
        
    done();
});

gulp.task('default', function(done) {
    gulp.watch("assets/sass/**/*.*", gulp.series('sass-compile'));
    done();
});