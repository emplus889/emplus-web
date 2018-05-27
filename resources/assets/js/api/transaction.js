import { EMPLUS_CONFIG } from '../config.js';

export default {
  
  // all transaction for this wallet
  index: function(no_wallet){
    return api.call('get',EMPLUS_CONFIG.API_URL + '/transaction/index/' + no_wallet);
  },
}