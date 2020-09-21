var webpack = require('webpack');

module.exports = {
  entry: './static/js/application.js',
  output: {
    filename: './static/js/bundle.js'
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin({
      compress: { warnings: false }
    })
  ],
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['es2015', 'react']
        }
      }
    ]
  },

  devServer: {
    host: 'localhost',
    port: 8032
  }
};
