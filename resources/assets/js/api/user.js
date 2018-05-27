import { EMPLUS_CONFIG } from '../config.js';

export default {
  
  // get user profil
  getUser: function(){
    return api.call('get',EMPLUS_CONFIG.API_URL + '/auth/getUser');
  },
}