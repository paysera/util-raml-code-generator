const path = require('path');

module.exports = () => {
    const config = {
        entry: {
            index: path.resolve(__dirname, 'src/index.js'),
        },
        output: {
            path: path.resolve(__dirname, 'dist/umd'),
            filename: 'main.js',
            libraryTarget: 'umd',
            library: 'vendorPublicTransfersClient'
        },
        module: {
            rules: [
                {
                    test: /\.jsx?$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader'
                }
            ],
        },
        devtool: 'source-map',
        externals: {
            '@paysera/money': {
                'root': 'PayseraMoney',
                'commonjs': '@paysera/money',
                'commonjs2': '@paysera/money',
                'amd': '@paysera/money',
            },
            '@paysera/http-client-common': {
                'root': 'PayseraHttpClientCommon',
                'commonjs': '@paysera/http-client-common',
                'commonjs2': '@paysera/http-client-common',
                'amd': '@paysera/http-client-common',
            },
        },
        resolve: {
            extensions: ['.js', '.jsx'],
        },
    };

    return config;
};
