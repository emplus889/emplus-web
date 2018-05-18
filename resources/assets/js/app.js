// all package/component used are imported here
import Vue from 'vue';
import Vuex from 'vuex';
import Vuetify from 'vuetify'
import VueRouter from 'vue-router';
import Axios from 'axios';
import moment from 'moment';
import store from './store';
import userRoutes from './routes/user';
import Main from './main.vue'; //main placeholder for entire vue app render
import 'vuetify/dist/vuetify.min.css'

// all package/component defined here
Vue.use(VueRouter); // handling routing on vue
Vue.use(Vuetify); // handling UI

window.moment = moment; // handling date formating
window.axios = Axios; // handing http post

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

// recheck user every route request
router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0);
    if (to.fullPath !== "/user/login") {
        axios.get('/api/v1/userId').then(response => {
            next(vm => vm.$store.dispatch('user/profile'));
        }).catch(error => {
            router.push('/user/login');
        })
    }else{
        next(vm => vm.$store.dispatch('user/profile'));
    }
});

const app = new Vue({
    store,
    router,
    render: h => h(Main)
}).$mount('#app');
