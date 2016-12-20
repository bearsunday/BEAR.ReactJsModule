module.exports = {
  react: 'src/react-bundle',
  ssr_example: 'src/page/example/app/server',
  example: [
    'webpack/hot/dev-server',
    'webpack-hot-middleware/client',
    'src/page/example/app/client',
  ],
};
