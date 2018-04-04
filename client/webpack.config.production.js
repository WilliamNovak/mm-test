const { resolve } = require('path')
const webpack = require('webpack')

const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const PreloadWebpackPlugin = require('preload-webpack-plugin');
const CompressionPlugin = require('compression-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const WebpackMonitor = require('webpack-monitor');

module.exports = {
    entry: [
        resolve(__dirname, 'src/index.jsx')
    ],
    output: {
        filename: '[name].js?t=' + new Date().getTime(),
        chunkFilename: '[name]-chunk.js?t=' + new Date().getTime(),
        path: resolve(__dirname, 'build'),
        publicPath: '/'
    },
    resolve: {
        extensions: ['.js', '.jsx']
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
                test: /\.es6$/,
                loader: "babel-loader",
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015', 'stage-0'],
                    plugins: [
                        'transform-object-rest-spread', 'transform-es2015-arrow-functions', 'transform-class-properties'
                    ]
                }
            },
            {
                test: /\.js$/,
                loader: "babel-loader",
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015', 'stage-0'],
                    plugins: [
                        'transform-object-rest-spread', 'transform-es2015-arrow-functions', 'transform-class-properties'
                    ]
                }
            },
            {
                test: /\.jsx$/,
                loader: "babel-loader",
                exclude: /node_modules/,
                query: {
                    presets: ['react', 'es2015', 'stage-0'],
                    plugins: [
                        'transform-object-rest-spread', 'transform-es2015-arrow-functions', 'transform-class-properties'
                    ]
                }
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                minimize: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.scss?$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        { loader: 'css-loader!sass-loader', options: { minimize: true } }
                    ]
                })
            },
            {
                test: /\.(png|jpg|jpeg|gif|woff|woff2|eot|ttf|svg|ico)$/,
                loaders: [
                    "file-loader?context=public&name=./dist/[path][name].[ext]"
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
    plugins: [
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        }),
        new webpack.optimize.DedupePlugin(),
        new CleanWebpackPlugin('build/*.*'),
        new ExtractTextPlugin('bundle.css', {
            allowChunks: true
        }),
        new webpack.optimize.ModuleConcatenationPlugin(),
        new webpack.HashedModuleIdsPlugin(),
        new PreloadWebpackPlugin({
            rel: 'preload',
            as: 'script',
            include: 'all',
            fileBlacklist: [/\.(css|map)$/, /base?.+/]
        }),
        new HtmlWebpackPlugin({
            hash: true,
            environment: process.env.NODE_ENV,
            template: resolve(__dirname, 'src/html/index.html'),
            filename: 'index.html',
            minify: {
                collapseWhitespace: false,
                collapseInlineTagWhitespace: true,
                removeComments: false,
                removeRedundantAttributes: true
            }
        }),
        new webpack.NoEmitOnErrorsPlugin(),
        new webpack.optimize.UglifyJsPlugin({
            mangle: true,
            compress: {
                warnings: false,
                pure_getters: true,
                unsafe: true,
                unsafe_comps: true,
                screw_ie8: true
            },
            output: {
                comments: false,
            },
            exclude: [/\.min\.js$/gi]
        }),
        new webpack.optimize.AggressiveMergingPlugin(), //Merge chunks
        new CompressionPlugin({
            asset: "[path].gz[query]",
            algorithm: "gzip",
            test: /\.js$|\.css$|\.html$/,
            threshold: 10240,
            minRatio: 0.8
        }),
        new WebpackMonitor({
            capture: true, // -> default 'true'
            target: '../monitor/myStatsStore.json', // default -> '../monitor/stats.json'
            launch: true, // -> default 'false'
            port: 3030, // default -> 8081
            excludeSourceMaps: true // default 'true'
        })
    ]
}
