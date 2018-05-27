import { EMPLUS_CONFIG } from '../config.js';

export default {
  
  // get user profil
  getBalance: function(id){
    return api.call('get',EMPLUS_CONFIG.API_URL + '/wallet/getBalance/' + id);
  },

  transferBalance: function(form){
    return api.call('post',EMPLUS_CONFIG.API_URL + '/wallet/transferBalance',form);
  },

  checkWalletNo: function(form){
    return api.call('post',EMPLUS_CONFIG.API_URL + '/wallet/checkWalletNo',form);
  }
}