import TransactionAPI from '../../api/transaction.js';

export const transaction = {
  namespaced: true,

  // state
  state: {
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

    // all transaction for this wallet
    index( { commit }, no_wallet ){
      commit('setDataStatS', 'loading');
      
      TransactionAPI.index( no_wallet )
        .then( function( response ){
          commit('setDataS', response.data.model );
          commit('setDataStatS', 'success');
        })
        .catch( error => {
          commit('setDataS', error.response);
          commit('setDataStatS', 'fail');
        });
    },

    // reset
    resetUpdateStat( {commit} ){
      commit('setUpdateStat', '');
    },
  },

  // mutations
  mutations: {
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