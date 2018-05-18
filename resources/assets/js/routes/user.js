//all view component is imported here
import userHeader from '../user/components/header.vue';
import userLogin from '../user/views/login.vue';

//all routes
const routes = [
  // login
	{ path: '/user/login',name: 'userLogin', components: { default: userLogin } },
]

//export routes
export default routes