import Vue from 'vue'
import Router from 'vue-router'
import { store } from '@/main.js'
import auth from '@/middleware/auth'
Vue.use(Router)
const router = new Router({
	mode: 'history',
	scrollBehavior(to) {
        if (to.hash) {
            return window.scrollTo({ top: document.querySelector(to.hash).offsetTop, behavior: 'smooth' });
        }
        return window.scrollTo({ top: 0, behavior: 'smooth' });
    },
	routes: [
		{
			path: '/',
			meta : {
				middleware : [auth],
			},
			component: () => import( /* webpackChunkName: "dashboard" */ '@/views/dashboard/layout.vue'),
			children : [
				{
					path : '',
					name : 'Dashboard',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "dashboard" */ '@/views/dashboard/index.vue'),
				},
			]
		},
		{
			path: '/user',
			meta : {
				middleware : [auth],
			},
			component: () => import( /* webpackChunkName: "discount" */ '@/views/user/layout.vue'),
			children : [
				{
					path: '',
					name : 'User',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/user/index.vue')
				},
				{
					path: 'create',
					name : 'CreateUser',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/user/create.vue')
				},
				{
					path: ':id',
					name : 'EditUser',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/user/edit.vue')
				}
			]
		},
		{
			path: '/category',
			meta : {
				middleware : [auth],
			},
			component: () => import( /* webpackChunkName: "discount" */ '@/views/category/layout.vue'),
			children : [
				{
					path: '',
					name : 'Category',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/category/index.vue')
				},
				{
					path: 'create',
					name : 'CreateCategory',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/category/create.vue')
				},
				{
					path: ':id',
					name : 'EditCategory',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/category/edit.vue')
				}
			]
		},
		{
			path: '/post',
			meta : {
				middleware : [auth],
			},
			component: () => import( /* webpackChunkName: "discount" */ '@/views/post/layout.vue'),
			children : [
				{
					path: '',
					name : 'Post',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/post/index.vue')
				},
				{
					path: 'create',
					name : 'CreatePost',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/post/create.vue')
				},
				{
					path: ':id',
					name : 'EditPost',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/post/edit.vue')
				}
			]
		},
		{
			path: '/gallery',
			meta : {
				middleware : [auth],
			},
			component: () => import( /* webpackChunkName: "discount" */ '@/views/gallery/layout.vue'),
			children : [
				{
					path: '',
					name : 'Gallery',
					meta : {
						middleware : [auth],
					},
					component: () => import( /* webpackChunkName: "discount" */ '@/views/gallery/index.vue')
				},
			]
		},
		{
			path: '/login',
			name: 'Login',
			meta: {
				layout: 'auth',
			},
			component: () => import( /* webpackChunkName: "auth" */ '@/views/auth/index.vue')
		},
		{
			path: '*',
			name: '404',
			meta: {
				layout: 'error'
			},
			component: () => import( /* webpackChunkName: "error" */ '@/views/errors/_404.vue')
		},
	]
})


router.beforeEach( async (to, from, next) => {
	/* run middleware in current route */
	if (to.meta.middleware) {
		const middleware = to.meta.middleware
        const context = { next , from , to , router, store };
		var preventNext = false
		for (let i = 0; i < middleware.length; i++) {
			const result = await middleware[i](context);
			if( !result ){
				preventNext = true
				break
			}
		}
		if( preventNext ){
			return;
		}
	}
	return next()
});

export default router