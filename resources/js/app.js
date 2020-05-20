require('./bootstrap')
window.Vue = require('vue')
import router from './router'
import store from './store'
import common from './common'
Vue.component('login', require('./components/pages/login.vue').default)
Vue.component('mainapp', require('./components/mainapp.vue').default)
Vue.component('sidemenu', require('./components/menu/sidemenu.vue').default)
Vue.component('topnav', require('./components/menu/topnav.vue').default)

Vue.mixin(common)

import ViewUI from 'view-design'
import 'view-design/dist/styles/iview.css'
Vue.use(ViewUI);

const app = new Vue({
    el: '#app',
    router,
    store,
})