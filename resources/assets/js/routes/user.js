//all view component is imported here
import full from '../containers/full.vue';
import userLogin from '../user/views/login.vue';
import userRegister from '../user/views/register.vue';
import userDashboard from '../user/views/dashboard.vue';
import userWallet from '../user/views/wallet.vue';
import userTopUp from '../user/views/topup.vue';
import userTransfer from '../user/views/transfer.vue';
import userPromo from '../user/views/promo.vue';

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
    redirect: '/user/dashboard',
    name: 'User Home', 
    components: { default: full },
    meta: { middlewareAuth: true },
    children:[
      {
        path: 'dashboard',
        name: 'Dashboard',
        component: userDashboard
      },
      {
        path: 'wallet',
        name: 'Wallet',
        component: userWallet
      },
      {
        path: 'topUp',
        name: 'Top Up',
        component: userTopUp
      },
      {
        path: 'transfer',
        name: 'Transfer',
        component: userTransfer
      },
      {
        path: 'promo',
        name: 'Promo',
        component: userPromo
      }
    ] 
  },
]

//export routes
export default routes