const { resolve } = require('path')
const webpack = require('webpack')

var ExtractTextPlugin = require("extract-text-webpack-plugin")

module.exports = {
    entry: [
        'react-hot-loader/patch',
        'webpack-dev-server/client?http://localhost:8080',
        'webpack/hot/only-dev-server',
        resolve(__dirname, 'src/index.jsx')
    ],
    output: {
        filename: 'bundle.js',
        path: resolve(__dirname, 'public'),
        publicPath: '/'
    },
    devtool: 'inline-source-map',
    resolve: {
        extensions: ['.js', '.jsx', '*']
    },
    stats: {
        hash: true,
        version: true,
        timings: true,
        assets: true,
        chunks: true,
        modules: true,
        reasons: true,
        children: true,
        source: false,
        errors: true,
        errorDetails: true,
        warnings: true,
        publicPath: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: "babel-loader",
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015', 'stage-0'],
                    plugins: ['transform-object-rest-spread', 'transform-es2015-arrow-functions', 'transform-class-properties']
                }
            },
            {
                test: /\.jsx$/,
                loader: "babel-loader",
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015', 'stage-0'],
                    plugins: ['transform-object-rest-spread', 'transform-es2015-arrow-functions', 'transform-class-properties']
                }
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract('css-loader')
            },
            {
                test: /\.(png|jpg|jpeg|woff|woff2|eot|ttf|svg|ico)$/,
                loaders: [
                    "file-loader?context=public&name=./public/[path][name].[ext]"
                ]
            },
            {
                test: /\.json?$/,
                loader: 'json'
            },
            {
                test: /\.html$/,
                loader: 'html-loader'
            }
        ]
    },
    devServer: {
        hot: true,
        contentBase: resolve(__dirname, 'public'),
        publicPath: '/',
        historyApiFallback: true,
        historyApiFallback: {
            index: '/index.html',
        }
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NamedModulesPlugin(),
        new ExtractTextPlugin('bundle.css', {
            allowChunks: true
        }),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        })
    ]
}
