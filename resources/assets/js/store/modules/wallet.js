import WalletAPI from '../../api/wallet.js';

export const wallet = {
  namespaced: true,

  // state
  state: {
    wallet: {},
    data: {}, //single data
    dataS: [], //collection
    walletStat: '',
    dataStat: '',
    dataStatS: '',
    update: [], //update data
    updateStat: '',
    rules: [], //laravel rules
    options: [], //laravel options
  },

  // getters
  getters: {
    wallet: state => state.wallet,
    data: state => state.data,
    dataS: state => state.dataS,
    walletStat: state => state.walletStat,
    dataStat: state => state.dataStat,
    dataStatS: state => state.dataStatS,
    update: state => state.update,
    updateStat: state => state.updateStat,
    rules: state => state.rules,
    options: state => state.options,
  },

  actions: {

    //user profil
    getBalance( { commit }, id ){
      commit('setWalletStat', 'loading');
      
      WalletAPI.getBalance( id )
        .then( function( response ){
          commit('setWallet', response.data.model );
          commit('setWalletStat', 'success');
        })
        .catch( error => {
          commit('setWallet', error.response);
          commit('setWalletStat', 'fail');
        });
    },

    transferBalance( {commit, state, dispatch}, form ){
      commit('setUpdateStat', 'loading');

      WalletAPI.transferBalance( form )
        .then( function( response ){
          if(response.data.saved){
            commit('setUpdate', response.data);
            commit('setUpdateStat', 'success');
          }else{
            commit('setUpdateStat', 'fail');
          }
        })
        .catch(error => {
          commit('setUpdate', error.response);   
          commit('setUpdateStat', 'fail');
        });
    },

    // reset
    resetUpdateStat( {commit} ){
      commit('setUpdateStat', '');
    },
  },

  // mutations
  mutations: {
    setWallet ( state, data ){
      state.wallet = data;
    },
    setData ( state, data ){
      state.data = data;
    },
    setDataS ( state, data ){
      state.dataS = data;
    },
    setWalletStat( state, status ){
      state.walletStat = status;
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