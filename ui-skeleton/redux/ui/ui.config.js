const path = require('path');

const base = path.join(__dirname, '../');
const entry = require('./entry.js');

module.exports = {
  public: path.join(base, 'var/www'),
  build: path.join(base, 'var/www/dist'),
  watch_to_sync: [
    path.join(base, 'src/**/*.php'),
    path.join(base, 'src/**/*.twig'),
    path.join(base, 'src/**/*.css'),
    path.join(base, 'src/**/*.html'),
  ],
  cleanup_dir: [
    path.join(base, 'var/tmp/*'),
  ],
  server: '127.0.0.1:8080',
  entry,
};
