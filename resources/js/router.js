import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import home from './components/pages/home'
import cards from './components/pages/cards'
import tag from './components/pages/tag'
import category from './components/pages/category'
import users from './components/pages/users'


import usecomp from './vuex/usecomp'

const routes = [
	{
		path: '/',
		component: home
	},
	{
		path: '/cards',
		component: cards
	},
	{
		path: '/tag',
		component: tag
	},
	{
		path: '/category',
		component: category
	},
	{
		path: '/users',
		component: users
	},
	{
		path: '/textvuex',
		component: usecomp
	},

]

export default new Router({
	mode:'history',
	routes
})