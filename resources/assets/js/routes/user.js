//all view component is imported here
import full from '../containers/full.vue';
import userHeader from '../user/components/header.vue';
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
  { path: '/user',
    name: 'userDashboard', 
    components: { default: full },
    meta: { middlewareAuth: true } },
]

//export routes
export default routes