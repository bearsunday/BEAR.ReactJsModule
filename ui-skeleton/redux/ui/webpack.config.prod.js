const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');
const uiConfig = require('./ui.config.js');
const webpack = require('webpack');

module.exports = {
  devtool: 'cheap-module-source-map',
  entry: uiConfig.entry,
  output: {
    filename: '[name].bundle.js',
    path: uiConfig.build,
    publicPath: '/dist/',
  },
  module: {
    loaders: [
      {
        test: /\.jsx?$/,
        enforce: 'pre',
        loaders: ['eslint-loader'],
        exclude: /(node_modules)/,
      },
      {
        test: /\.jsx?$/,
        loaders: ['babel-loader'],
        exclude: /(node_modules)/,
      },
      {
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({ fallbackLoader: 'style-loader', loader: 'css-loader' }),
      },
      {
        test: /\.json$/,
        loader: 'json-loader',
      },
      {
        test: /\.(eot|woff|woff2|ttf|svg|png|jpe?g|gif)(\?\S*)?$/,
        loader: 'url-loader',
      },
    ],
  },
  resolve: {
    modules: [
      path.join(__dirname, '/../node_modules'),
      __dirname,
    ],
    extensions: ['.js', '.jsx'],
  },
  plugins: [
    new webpack.LoaderOptionsPlugin({
      minimize: true,
      debug: false,
    }),
  ],
};
