//all view component is imported here
import full from '../containers/full.vue';
import userLogin from '../user/views/login.vue';
import userRegister from '../user/views/register.vue';
import userDashboard from '../user/views/dashboard.vue';

//all routes
const routes = [
  // login
  { path: '/user/login',
    name: 'userLogin', 
    components: { default: userLogin },
    meta: { userLogin: true } },
  
  // register
  { path: '/user/register',
    name: 'userRegister', 
    components: { default: userRegister },
    meta: { userLogin: true } },  
  
  // dashboard
  { path: '/',
    redirect: '/user',
    name: 'User Home', 
    components: { default: full },
    meta: { middlewareAuth: true },
    children:[
      {
        path: 'user',
        name: 'Dashboard',
        component: userDashboard
      }
    ] 
  },
]

//export routes
export default routes