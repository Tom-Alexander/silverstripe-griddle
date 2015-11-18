

var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: {
    "GriddleField": "./js/source/index.js"
  },
  output: {
    filename: "./js/GriddleField.bundle.js"
  },
  module: {
    loaders: [
      { test: /\.js$/, loader: "babel" },
      { test: /\.css$/, loader: ExtractTextPlugin.extract("style-loader", "raw-loader") },
      { test: /\.less$/, loader: ExtractTextPlugin.extract("style-loader", "raw-loader!less-loader")}
    ]
  },
  plugins: [new ExtractTextPlugin('./css/[name].css')]
};
