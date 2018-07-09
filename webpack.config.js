const path = require('path')
const webpack = require('webpack')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')

const production = process.env.NODE_ENV === 'production'

let dirCopyPatterns = [
    {
        from: 'app/Resources/assets/icons',
        to: 'icons'
    },
    {
        from: 'app/Resources/assets/images',
        to: 'images'
    }
]


let config = {
    entry: {
        app: [
            './app/Resources/assets/scss/app.scss',
            './app/Resources/assets/js/app.js'
        ],
        plugins: [
            './app/Resources/assets/js/check-integrity.js'
        ],
        vendor: [
            'jquery',
            'popper.js',
            'bootstrap'
        ]
    },
    output: {
        path: path.resolve(__dirname, 'web'),
        filename: production ? 'js/[name].[chunkhash].js' : 'js/[name].js'
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: true,
                                importLoaders: 1
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                indent: 'postcss',
                                sourceMap: true,
                                plugins: [
                                    require('autoprefixer')
                                ]
                            }
                        }, {
                            loader: 'resolve-url-loader?sourceMap'
                        }, {
                            loader: 'sass-loader',
                            options: {
                                precision: 8,
                                outputStyle: 'expanded',
                                sourceMap: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.(png|svg|jpe?g|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: (path) => {
                                if (!/node_modules/.test(path)) {
                                    return production ? '/images/[name].[ext][hash]'
                                        : '/images/[name].[ext]'
                                }

                                return `images/vendor-${name}/` + path
                                    .replace(/\\/g, '/')
                                    .replace(
                                        /((.*(node_modules))|images|image|img|assets)\//g, ''
                                    ) + '?[hash]'
                            }
                        }
                    },
                    {
                        loader: 'img-loader',
                        options: {
                            enabled: production
                        }
                    }
                ]
            },
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),
        new ExtractTextPlugin({
            filename: production
                ? 'dist/css/[name].[contenthash].css'
                : 'css/[name].css',
            allChunks: true,
        }),
        new CopyWebpackPlugin(dirCopyPatterns, { copyUnmodified: true })
    ]
}

module.exports = config;
