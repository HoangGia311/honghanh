import Vue from 'vue'
import cookie from 'js-cookie'
import store from '@/store'
import router from '@/router'
import { default as instance } from 'axios'
let token_name = process.env.VUE_APP_TOKEN_NAME ? process.env.VUE_APP_TOKEN_NAME : 'token'
let AxiosConfig = {
	baseURL: process.env.VUE_APP_ROOT_API || "",
	timeout: 60 * 1000,
	validateStatus: function (status) {
		return status >= 200 && status < 500 ;
	},
};

let axios = instance.create(AxiosConfig);

axios.interceptors.request.use(function (config) {
	let token = cookie.get(token_name)
	if( token ){
		config.headers['Authorization'] = 'Bearer ' + token
	} 
    return config;
});

axios.interceptors.response.use(function (response) {
	let { status } = response 
	if( status === 400 || status === 401 ){
		store.dispatch('auth/logout')
		let { message  = 'Your session is expired'} = response.data
		app.$toasted.error(message)
	}
    return response;
    return response;
}, function (error ) {
    return Promise.reject(error);
});

Plugin.install = function (Vue, options) {
	Vue.axios = axios;
	window.axios = axios;
	Object.defineProperties(Vue.prototype, {
		axios: {
			get() {
				return axios;
			}
		},
		$axios: {
			get() {
				return axios;
			}
		},
	});
};

Vue.use(Plugin)
export default Plugin;