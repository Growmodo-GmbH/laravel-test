const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
    transpileDependencies: true,
    configureWebpack: {
        entry: {
            app: './resources/js/app.js'
        }
    }
})