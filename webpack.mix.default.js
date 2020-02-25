const path = require('path');
const fs = require('fs-extra');
const webpack = require('webpack');
const mix = require('laravel-mix');
require('laravel-mix-versionhash');
require('laravel-mix-merge-manifest');

mix.js('resources/js/default/app.js', 'dist/default/js')
  .sass('resources/js/default/assets/scss/app.scss', 'dist/default/css')
  .disableNotifications()
  .mergeManifest();;

if (mix.inProduction()) {
  mix.versionHash();
} else {
  mix.sourceMaps();
}

mix.webpackConfig({
  plugins: [
    new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
  ],
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js/default')
    }
  },
  output: {
    chunkFilename: 'dist/js/default/[chunkhash].js',
    path: mix.config.hmr ? '/' : path.resolve(__dirname, './public/'),
  },
});

mix.then(() => {
  if (!mix.config.hmr) {
    process.nextTick(() => publishAssets());
  }
});

function publishAssets () {
  const publicDir = path.resolve(__dirname, './public');

  if (mix.inProduction()) {
    fs.removeSync(path.join(publicDir, 'dist/default'));
  }

  fs.copySync(path.join(publicDir, 'build', 'dist/default'), path.join(publicDir, 'dist/default'));
  fs.removeSync(path.join(publicDir, 'build'));
}