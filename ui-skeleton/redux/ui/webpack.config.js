var ExtractTextPlugin = require("extract-text-webpack-plugin");
var path = require("path");
var uiConfig = require('./ui.config.js');
var webpack = require('webpack');

module.exports = {
    debug: true,
    devtool: '#eval-source-map',
    entry: uiConfig.entry,
    output: {
        filename: '[name].bundle.js',
        path: uiConfig.build,
        publicPath: "/dist/"
    },
    module: {
        preLoaders: [
            {
                test: /\.(js|jsx)$/,
                loader: "eslint",
                exclude: /node_modules/
            }
        ],
        loaders: [
            {
                test: /\.(js|jsx)$/,
                loaders: ['react-hot', 'babel'],
                exclude: /(node_modules)/
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract("style", "css")
            },
            {
                test: /\.json$/,
                loader: 'json'
            },
            {
                test: /\.(eot|woff|woff2|ttf|svg|png|jpe?g|gif)(\?\S*)?$/,
                loader: 'url'
            }
        ]
    },
    resolve: {
        modulesDirectories: [__dirname + '/../node_modules', __dirname],
        extensions: ["", ".webpack-loader.js", ".web-loader.js", ".loader.js", ".js", ".jsx"]
    },
    plugins: [
        new webpack.optimize.OccurenceOrderPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NoErrorsPlugin(),
        new ExtractTextPlugin("style.css", {
            allChunks: true
        })
    ]
};
