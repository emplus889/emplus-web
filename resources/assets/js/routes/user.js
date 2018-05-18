//all view component is imported here
import userHeader from '../user/components/header.vue';
import userLogin from '../user/views/login.vue';
import userDashboard from '../user/views/dashboard.vue';

//all routes
const routes = [
  // login
  { path: '/user/login',name: 'userLogin', components: { default: userLogin } },
  
  // dashboard
	{ path: '/user',name: 'userDashboard', components: { default: userDashboard,'header': userHeader  } },
]

//export routes
export default routes