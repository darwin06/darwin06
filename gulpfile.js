'use strict';

// ! COMMAND TO FIX ERROR ACCESS
// ! https://www.fahidjavid.com/fix-error-eacces-permission-denied-mkdir/
// ! sudo npm install --unsafe-perm=true --allow-root

// * VARIABLES
var gulp = require('gulp');
let sass = require('gulp-sass')(require('sass'));
var cssnano = require('gulp-cssnano');
var sourcemaps = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var del = require('del');
var uglify = require('gulp-uglify');
var eslint = require('gulp-eslint');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
// var imagemin = require('gulp-imagemin');
var gcmq = require('gulp-group-css-media-queries');
var browserSync = require('browser-sync').create();
var babel = require('gulp-babel');

// ! Change this path to URL workspace
// var pathDir = 'http://localhost:8080/wordpress/';
var pathDir = 'https://tabbank.test/';

// Set the browser that you want to support
const AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

// * SASS
// * =================================
gulp.task('sass', function () {
  return gulp.src('assets/sass/*.scss')
    .pipe(sourcemaps.init({ loadMaps: true, largeFile: true }))
    .pipe(sass().on('error', sass.logError))
    // .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(postcss([
      autoprefixer({
        browsers: AUTOPREFIXER_BROWSERS,
        cascade: false
      }),
      require('postcss-flexbugs-fixes')
    ]))
    .pipe(gcmq())
    .pipe(sourcemaps.write('../maps'))
    .pipe(gulp.dest('assets/css/source'))
    .pipe(browserSync.stream());
});

// * CSS
// * =================================
gulp.task('cssmin', function () {
  return gulp.src(['assets/css/source/style.css'])
    .pipe(rename({
      extname: ".min.css"
    }))
    .pipe(sourcemaps.init())
    .pipe(cssnano())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream());
});

// * CSS ABOVE THE FOLD
// * =================================
gulp.task('cssminabove', function () {
  return gulp.src(['assets/css/source/above-the-fold.css'])
    .pipe(rename({
      extname: ".min.css"
    }))
    .pipe(sourcemaps.init())
    .pipe(cssnano())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream());
});

// * ESLINT
// * ==================================
gulp.task('eslint', () => {
  return gulp.src(['assets/js/source/**/*.js'])
    .pipe(eslint({
      "extends": "eslint:recommended",
      "rules": {
        "indent": ["error", 2],
        "linebreak-style": ["error", "unix"],
        "camelcase": 1,
        "comma-dangle": ["error", "always"],
        "no-cond-assign": ["error", "always"],
        "eqeqeq": "warn",
        "curly": "error",
        "semi": ["error", "always"],
        "quotes": ["error", "single"]
      },
      globals: [
        'jQuery',
        '$'
      ],
      fix: true
    }))
    .pipe(eslint.format())
    .pipe(eslint.result(result => {
      // Called for each ESLint result.
      console.log(`ESLint result: ${result.filePath}`);
      console.log(`# Messages: ${result.messages.length}`);
      console.log(`# Warnings: ${result.warningCount}`);
      console.log(`# Errors: ${result.errorCount}`);
    }))
    .pipe(eslint.failAfterError());
});

// * UGLIFY
// * =================================
gulp.task('scripts', function () {
  return gulp.src('assets/js/source/**/*.js')
    /*
    .pipe(babel({
      presets: ['@babel/preset-env']
    }))
    */
    .pipe(rename({
      extname: ".min.js"
    }))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(browserSync.stream());
});

// * Images
// * =================================
gulp.task('images', function () {
  return gulp.src('assets/images/**/*')
    .pipe(imagemin([
      imagemin.gifsicle({ interlaced: true }),
      imagemin.jpegtran({ progressive: true }),
      imagemin.optipng({ optimizationLevel: 5 }),
      imagemin.svgo({
        plugins: [
          { removeViewBox: true },
          { cleanupIDs: false }
        ]
      })
    ]))
    .pipe(gulp.dest('assets/images/'))
});


// * SYNC
// * ===============================
gulp.task('sync', function () {
  browserSync.init({
    proxy: pathDir
  });

  gulp.watch('assets/sass/**/*.scss', gulp.series(['sass', 'cssmin', 'cssminabove']));
  gulp.watch('assets/js/source/**/*.js', gulp.series(['eslint', 'scripts']));
  gulp.watch('**/*.php').on('change', browserSync.reload);

});


// * START WORKFLOW
// * ===============================
gulp.task('default', function () {
  gulp.watch('assets/sass/**/*.scss', gulp.series(['sass', 'cssmin', 'cssminabove']));
  gulp.watch('assets/js/source/**/*.js', gulp.series(['eslint', 'scripts']));
  //gulp.watch('assets/js/source/**/*.js', gulp.series(['scripts']));
});
