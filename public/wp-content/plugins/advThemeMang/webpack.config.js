const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { watch } = require("fs");

module.exports = {
  plugins: [
    new MiniCssExtractPlugin({
      filename: "advThemeMang-compiled.css",
    }),
  ],
  mode: "production",
  entry: {
    App: ["./assets/sass/advThemeMang.scss", "./assets/js/advThemeMang.js"],
  },
  output: {
    filename: "advThemeMang-compiled.js",
    path: path.resolve(__dirname, "assets/final-assets/"),
  },

  module: {
    rules: [
      {
        test: /\.scss$/i,
        use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
      },
      {
        test: /\.js$/i,
        exclude: /node_modules/,
        use: { loader: "babel-loader" },
      },
    ],
  },
  watch: true,
  devtool: "source-map",
};
