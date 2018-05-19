// all package/component used are imported here
import Vue from 'vue';
import Vuex from 'vuex';
import Vuetify from 'vuetify'
import VueRouter from 'vue-router';
import Axios from 'axios';
import moment from 'moment';
import auth from './auth.js';
import store from './store';
import userRoutes from './routes/user';
import Main from './main.vue'; //main placeholder for entire vue app render
import 'vuetify/dist/vuetify.min.css'

// all package/component defined here
Vue.use(VueRouter); // handling routing on vue
Vue.use(Vuetify); // handling UI

window.auth = auth; // handling authentication
window.moment = moment; // handling date formating
window.axios = Axios; // handling http post
window.Event = new Vue; // handling vue event

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



const app = new Vue({
    store,
    router,
    render: h => h(Main)
}).$mount('#app');
