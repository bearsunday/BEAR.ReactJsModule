const path = require('path');

module.exports = {
  devtool: 'cheap-module-eval-source-map',
  entry: {
    react: './ui/react-bundle',
    ssr_app: './ui/src/app/server',
    app: './ui/src/app/client',
  },
  output: {
    path: path.join(__dirname, '/../www/build'),
    filename: '[name].bundle.js',
    publicPath: '/static/',
  },
  plugins: [
  ],
  module: {
    rules: [{
      test: /\.jsx?$/,
      use: ['babel-loader'],
      exclude: /node_modules/,
      include: __dirname,
    }],
  },
};
