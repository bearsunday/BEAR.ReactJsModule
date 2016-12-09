var path = require('path')
var webpack = require('webpack')

module.exports = {
  devtool: 'cheap-module-eval-source-map',
  entry: {
    react: './ui/ssr/react-bundle',
    app: './ui/ssr/app',
  },
  output: {
    path: path.join(__dirname, '/../www/build'),
    filename: '[name].bundle.js',
    publicPath: '/static/'
  },
  plugins: [
  ],
  module: {
    loaders: [{
      test: /\.js$/,
      loaders: ['babel'],
      exclude: /node_modules/,
      include: __dirname
    }]
  }
}
