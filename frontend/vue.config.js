const webpack = require('webpack')
const path = require('path')
module.exports = {
	outputDir: '../public',
	indexPath: process.env.NODE_ENV === 'production'? '../resources/views/index.blade.php' : 'index.html',
	configureWebpack: {
		plugins: [
			new webpack.ProvidePlugin({
				$: ' ',
				'$': 'jquery',
				jquery: 'jquery',
				jQuery: 'jquery',
				'window.jquery': 'jquery',
				'window.jQuery': 'jquery',
				'window.$': 'jquery',
				'global.jquery': 'jquery',
				'global.jQuery': 'jquery',
				'global.$': 'jquery'
			}),
		],
	},
	devServer: {
    	port: 30000
	},
	lintOnSave: false,
	css: {
		loaderOptions: {
			sass: {
				data: `@import "@/styles/scss/static/_variables.scss";`
			}
		}
	},
}