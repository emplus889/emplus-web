import { EMPLUS_CONFIG } from '../config.js';

export default {
  
  // get user profil
  getBalance: function(id){
    return api.call('get',EMPLUS_CONFIG.API_URL + '/getBalance/' + id);
  },
}