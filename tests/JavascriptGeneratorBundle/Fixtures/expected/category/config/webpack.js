const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry:  {
        lib: path.resolve(__dirname, '../src/module.js'),
        'lib.min': path.resolve(__dirname, '../src/module.js'),
        'ng.module': path.resolve(__dirname, '../src/angular.module.js')
    },
    output: {
        path: path.resolve(__dirname, '../dist'),
        filename: '[name].js',
        libraryTarget: 'umd',
        library: 'vendorCategoryClient'
    },
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                include: [
                    path.resolve(__dirname, '../src')
                ],
                use: [
                    {
                        loader: 'ng-annotate-loader'
                    },
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['es2015']
                        }
                    },
                ]
            }
        ],
    },
    resolve: {
        modules: [
            'node_modules',
            path.resolve(__dirname, '../src')
        ],
        extensions: ['.js']
    },
    devtool: 'source-map',
    context: path.resolve(__dirname, '../'),
    target: 'web',
    externals: {
        'paysera-http-client-common': 'paysera-http-client-common',
        angular: 'angular'
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            include: /\.min\.js$/,
            sourceMap: true
        })
    ]
};
