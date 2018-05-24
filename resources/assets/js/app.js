// all package/component used are imported here
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'; // bootstrap ui framework
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import Axios from 'axios';
import moment from 'moment';
import Api from './api.js';
import Auth from './auth.js';
import store from './store';
import userRoutes from './routes/user';
import Main from './main.vue'; //main placeholder for entire vue app render

// all package/component defined here
Vue.use(BootstrapVue); // handing UI
Vue.use(VueRouter); // handling routing on vue

window.moment = moment; // handling date formating
window.axios = Axios; // handling http post
window.Event = new Vue; // handling vue event
window.api = new Api(); // handling axios api
window.auth = new Auth(); // handling authentication

// handling laravel csrf token validation and headers
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
let token = document.head.querySelector('meta[name="csrf-token"]');
      
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// handling basic url route 
const router = new VueRouter({
	base: '/app',
    mode: 'history',
    routes: [
        ...userRoutes
    ]
});

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.middlewareAuth)) {                
			if (!auth.check()) {
					next({
							path: '/user/login',
							query: { redirect: to.fullPath }
					});
					return;
			}
	}

	next();
})

const app = new Vue({
    store,
    router,
    render: h => h(Main)
}).$mount('#app');
