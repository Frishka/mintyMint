const path = require('path');
const webpack = require('webpack');

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');


const config = {
    distDir: './dist',
    assetsDir: './application/assets',
    node_modules : './node_modules'
};

module.exports = {
    mode: "development",
    entry: path.resolve(__dirname, config.assetsDir + '/js/app.js'),
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: ['@babel/preset-env']
                }
            },
            {
                test: /\.css$/,
                use: [
                    'css-loader'
                ]
            },
            {
                test: /\.(png|svg|woff2|woff|ttf|eot|jpe?g|gif)$/i,
                use: [
                    {
                        loader: 'file-loader',
                    },
                ],
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'sass-loader']
                })
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin('app.css'),
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: path.resolve(__dirname, config.node_modules + '/admin-lte/dist/img'),
                    to: path.resolve(__dirname, config.distDir + '/img')
                } ,
                {
                    from: path.resolve(__dirname, config.node_modules + '/font-awesome/fonts/'),
                    to: './fonts'
                }
            ]
        })
    ],
    output: {
        path: path.resolve(__dirname, config.distDir),
        filename: 'app.js'
    }
};