module.exports = {
  devServer: {
    proxy: {
      "^/api": {
        target: "http://localhost",
        logLevel: "debug",
      },
    },
  },
};
