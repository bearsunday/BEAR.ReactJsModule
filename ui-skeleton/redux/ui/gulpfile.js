const browserSync = require('browser-sync').create();
const connect = require('gulp-connect-php');
const del = require('del');
const fileExists = require('file-exists');
const gulp = require('gulp');
const path = require('path');
const phpcs = require('gulp-phpcs');
const phpmd = require('gulp-phpmd-plugin');
const uiConfig = require('./ui.config.js');
const webpack = require('webpack-stream');
const webpack2 = require('webpack');
const webpackConfig = require('./webpack.config.js');
const webpackDevMiddleware = require('webpack-dev-middleware');
const webpackHotMiddleware = require('webpack-hot-middleware');

const base = path.join(__dirname, '../');
const bundler = webpack2(webpackConfig);

gulp.task('clean', del.bind(null, uiConfig.cleanup_dir, { force: true }));

gulp.task('webpack', () => gulp.src('./src/**')
    .pipe(webpack(webpackConfig, webpack2))
    .pipe(gulp.dest(path.join(uiConfig.public, '/dist/'))));

gulp.task('reload', () => {
  browserSync.reload();
});

gulp.task('reload-php', ['clean'], () => {
  browserSync.reload();
});

gulp.task('php', ['webpack'], () => connect.server({
  port: 8080,
  base: uiConfig.public,
}));

gulp.task('browser-sync', ['php'], () => {
  browserSync.init({
    proxy: {
      target: '127.0.0.1:8080',
      middleware: [
        webpackDevMiddleware(bundler, {
          // IMPORTANT: dev middleware can't access config, so we should
          // provide publicPath by ourselves
          publicPath: webpackConfig.output.publicPath,

          // pretty colored output
          stats: { colors: true },

          // for other settings see
          // http://webpack.github.io/docs/webpack-dev-middleware.html
        }),

        // bundler should be the same as above
        webpackHotMiddleware(bundler),
      ],
    },

    // no need to watch '*.js' here, webpack will take care of it for us,
    // including full page reloads if HMR won't work
    files: [
      './src/**/*.css',
      './src/**/*.html',
      '../src/**/*.php',
    ],
  });
});

gulp.task('sync', ['browser-sync'], () => {
  gulp.watch(
    uiConfig.watch_to_sync,
    ['reload']
  );
});

gulp.task('php-clean', ['php'], () => {
  gulp.watch(
    '../src/**/*.php',
    ['clean']
  );
});

gulp.task('php-cs', ['php'], () => {
  gulp.watch(
    '../src/**/*.php',
    ['clean', 'phpcs', 'phpmd']
  );
});

gulp.task('phpcs', () => {
  const standard = fileExists(path.join(base, '/phpcs.xml')) ? path.join(base, '/phpcs.xml') : 'psr2';
  return gulp.src(`${base}/src/**/*.php`)
    .pipe(phpcs({
      bin: path.join(base, '/vendor/bin/phpcs'),
      standard,
      warningSeverity: 0,
      colors: true,
    }))
    .pipe(phpcs.reporter('log'));
});

gulp.task('phpmd', () => {
  const ruleset = fileExists(path.join(base, '/phpmd.xml')) ? path.join(base, '/phpmd.xml') : 'unusedcode';
  return gulp.src(path.join(base, '/src/**/*.php'))
    .pipe(phpmd({
      bin: path.join(base, 'vendor/bin/phpmd'),
      format: 'text',
      ruleset,
    }))
    .pipe(phpmd.reporter('log'));
});

// start web server
gulp.task('start', ['php', 'php-clean']);
// start web server with hot deploy
gulp.task('dev', ['sync', 'php-clean', 'php-cs']);
