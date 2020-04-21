const path = require("path");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    entry: "./assets/src/index.js",
    output: {
        path: path.join(__dirname, "./assets/dist/js"),
        filename: "main.js"
    },
    resolve: {
        extensions: ['.js', '.jsx', '.scss', '.gif', '.png', '.jpg', '.jpeg', '.svg']
    },
    module: {
        rules: [
            {
                test: /\.jsx|js$/,
                exclude: /node_modules/,

                use: {
                    loader: "babel-loader"
                },
            },
            {
                test: /\.(css|scss)$/,
                use: [
                    /* // for development mode
                    {
                        loader: "style-loader",
                        options: {
                            singleton: true
                        }
                    },
                    */
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            minimize: true
                        }
                    },
                    { loader: "css-loader" },
                    {
                        loader: "sass-loader",
                        options: {
                            sassOptions: {
                                indentWidth: 4,
                                includePaths: [
                                    'vendor/bower-asset/font-awesome/scss',
                                    'vendor/bower-asset/bootstrap-sass/assets/stylesheets'
                                ],
                            },
                        },
                    }
                ]
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: './../img/'
                    }
                }],
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: './../fonts/'
                    }
                }],
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].css'
        }),
        new CopyPlugin([
            { from: './assets/src/img', to: '../img' },
        ]),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            'window.$': 'jquery'
        }),
    ],
    optimization: {
        minimizer: [
            new OptimizeCSSAssetsPlugin({})
        ]
    }
};