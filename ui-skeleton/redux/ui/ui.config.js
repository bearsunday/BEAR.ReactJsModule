var path = require("path");
var base = path.join(__dirname, '../');
var entry = require('./entry.js');

module.exports = {
    public: base + 'var/www',
    build: base +  'var/www/dist',
    watch_to_sync: [
        base + 'src/**/*.php',
        base + 'src/**/*.twig',
        base + 'var/lib/twig/*.twig',
        base + 'ui/src/**/*.css',
        base + 'ui/src/**/*.html',
    ],
    cleanup_dir: [
        base + 'var/tmp/*',
    ],
    server: '127.0.0.1:8080',
    entry: entry
};
