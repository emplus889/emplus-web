import { EMPLUS_CONFIG } from '../config.js';

export default {
  
  // get user profil
  profile: function(){
    return axios.get(EMPLUS_CONFIG.API_URL + '/profile');
  },
}