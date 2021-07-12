const path = require("path");

module.exports = {
  chainWebpack: (config) => {
    config.entry("app").clear().add("./frontend/main.js").end();
    config.resolve.alias.set("@", path.join(__dirname, "./frontend"));
  },
  devServer: {
    port: 8080,
    disableHostCheck: true,
  },
};
