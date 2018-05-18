import UserAPI from '../../api/user.js';

export const user = {
  namespaced: true,

  // state
  state: {
    profile: {},
    profileStat: '',
    data: {}, //single data
    dataS: [], //collection
    dataStat: '',
    dataStatS: '',
    update: [], //update data
    updateStat: '',
    rules: [], //laravel rules
    options: [], //laravel options
  },

  // getters
  getters: {
    profile: state => state.profile,
    profileStat: state => state.profileStat,
    data: state => state.data,
    dataS: state => state.dataS,
    dataStat: state => state.dataStat,
    dataStatS: state => state.dataStatS,
    update: state => state.update,
    updateStat: state => state.updateStat,
    rules: state => state.rules,
    options: state => state.options,
  },

  actions: {

    //user profil
    profile( { commit }, p ){
      commit('setProfileStat', 'loading');
      
      UserAPI.profile( p )
        .then( function( response ){
          commit('setProfile', response.data.model );
          commit('setProfileStat', 'success');
        })
        .catch( error => {
          commit('setProfile', error.response);
          commit('setProfileStat', 'fail');
        });
    },

    // reset
    resetUpdateStat( {commit} ){
      commit('setUpdateStat', '');
    },
  },

  // mutations
  mutations: {
    setProfile ( state, profile ){
      state.profile = profile;
    },
    setProfileStat( state, status ){
      state.profileStat = status;
    },
    setData ( state, data ){
      state.data = data;
    },
    setDataS ( state, data ){
      state.dataS = data;
    },
    setDataStat( state, status ){
      state.dataStat = status;
    },
    setDataStatS( state, status ){
      state.dataStatS = status;
    },
    setUpdate ( state, data ){
      state.update = data;
    },
    setUpdateStat( state,status ){
      state.updateStat = status;
    },
    setRules( state, rules ){
      state.rules = rules;
    },
    setOptions( state, options ){
      state.options = options;
    }
  }

}