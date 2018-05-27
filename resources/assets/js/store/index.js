import Vue from 'vue';
import Vuex from 'vuex';

import { user } from './modules/user';
import { wallet } from './modules/wallet';
import { transaction } from './modules/transaction';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    user,
    wallet,
    transaction
  }
});