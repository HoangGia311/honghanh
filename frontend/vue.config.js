const webpack = require('webpack')
module.exports = {
	publicPath: process.env.NODE_ENV === 'production'? '/admin-portal/' : '/',
	outputDir: '../public/admin-portal',
	indexPath: process.env.NODE_ENV === 'production'? '../../resources/views/index.blade.php' : 'index.html',
	configureWebpack: {
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
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
		]
	},
	lintOnSave: false,
	devServer: {
    	port: 12345
	},
	css: {
		loaderOptions: {
			sass: {
				data: `@import "@/styles/scss/static/_variables.scss";`
			}
		}
	}
}
