var syntax        = 'scss'; 

var gulp          = require('gulp'),
    autoprefixer  = require('gulp-autoprefixer'),
    browsersync   = require('browser-sync'),
    concat        = require('gulp-concat'),
    cache         = require('gulp-cache'),
    cleancss      = require('gulp-clean-css'),
    webpack       = require('webpack'),
    webpackStream = require('webpack-stream'),
    notify        = require('gulp-notify'),
    rename        = require('gulp-rename'),
	sass 		  = require('gulp-sass')(require('sass')),
    uglify        = require('gulp-uglify'),
    plumber 	  = require("gulp-plumber"),
    gcmq 		  = require('gulp-group-css-media-queries');

/**
 *  =================================================
 *  CONSTS
 *  =================================================
 */

const proxy_browsersync = "openkurban.local"
const theme = "src/wp-content/themes/theme/";
const src = {
    php: theme + "**/*.php",
    scss: theme + "assets/scss/**/*.scss",
    css: theme + "assets/css/",
    js: theme + "assets/js/",
}

/**
 *  =================================================
 *  Gulp Tasks
 *  =================================================
 */

// Незабываем менять 'wp-gulp.loc' на свой локальный домен
gulp.task('browser-sync', function() {
    browsersync({
        proxy: proxy_browsersync,
        notify: false,
    })
});

// Отслеживаем php
gulp.task('php', function() {
    return gulp.src( theme+'*.php' )
        .pipe(browsersync.reload({ stream: true }))
});

// Обьединяем файлы sass, сжимаем и переменовываем
gulp.task('styles', function() {
	return gulp.src(src.scss)
	
	.pipe(plumber({
		errorHandler: function(err) {
			notify.onError({
				title: "SCSS Error",
				message: "Error: <%= error.message %>"
			})(err);
			this.emit('end');
		}
	}))
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(gcmq())
	//.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(concat('global.css'))
	.pipe(autoprefixer(['last 15 versions']))
	// .pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest(theme))
	.pipe(browsersync.reload({ stream: true }))
});


// Обьединяем файлы скриптов, сжимаем и переменовываем
gulp.task('scripts', function() {
    return gulp.src(src.js)

    .pipe(webpackStream({
            mode: "development",
            devtool: 'source-map', // eval - production none, source-map - production turn on
			// target: 'node',
            // config: {
            //     node: {
            //         fs: 'empty',
            //     }
            //   },
			resolve: {
				fallback: { 
				"path": require.resolve("stream-browserify"),
                "os": require.resolve("os-browserify/browser"),
                "domain": require.resolve("domain-browser"),
                "stream": require.resolve("stream-browserify"),
                "constants": require.resolve("constants-browserify"),
				"domain": require.resolve("domain-browser"),
                fs: false,
				},
			},
            entry: [
                './' + src.js + 'scripts.js',
            ],
            output: {
                filename: 'all.js',
                path: __dirname + src.js,
            }
        }))
        .pipe(gulp.dest(src.js))
        .pipe(browsersync.reload({ stream: true }))
});




gulp.task('watch', function() {
    gulp.watch( src.scss, gulp.parallel('styles'), browsersync.reload); // Наблюдение за scss файлами в папке scss в теме
    gulp.watch( theme + "assets/js/scripts.js", gulp.parallel('scripts'), browsersync.reload); // Наблюдение за JS файлами в папке js
    gulp.watch( src.php,  gulp.parallel('php'), browsersync.reload) // Наблюдение за php файлами php в теме
});
gulp.task('default', gulp.series(gulp.parallel('styles', 'scripts'), gulp.parallel('browser-sync', 'watch')));