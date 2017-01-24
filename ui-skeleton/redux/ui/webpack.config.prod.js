var ExtractTextPlugin = require("extract-text-webpack-plugin");
var path = require("path");
var uiConfig = require('./ui.config.js');
var webpack = require('webpack');

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
        loaders: ['react-hot-loader', 'babel-loader'],
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
      path.resolve(__dirname + '/../node_modules'),
      __dirname,
    ],
    extensions: ['.js', '.jsx'],
  },
  plugins: [
    new webpack.NoEmitOnErrorsPlugin(),
  ],
};
