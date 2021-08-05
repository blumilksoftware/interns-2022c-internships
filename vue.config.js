const path = require("path");

module.exports = {
  chainWebpack: (config) => {
    config.entry("app").clear().add("./frontend/main.js").end();
    config.resolve.alias.set("@", path.join(__dirname, "./frontend"));
    config.plugin("html").tap((args) => {
      args[0].template = "./frontend/templates/index.html";
      return args;
    });
  },
  devServer: {
    port: 8080,
    disableHostCheck: true,
  },
  publicPath: process.env.NODE_ENV === "production" ? "/internships/" : "/",
};
