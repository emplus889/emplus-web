<template>
  <div class="animated fadeIn">
    <b-row>
      <!-- wallet -->
      <b-col sm="12" md="12" lg="12">
        <b-card class="text-white bg-primary">
          <div class="h1 text-right mb-4">
            <i class="icon-wallet"></i>
          </div>
          <div class="h4 mb-0">{{ wallet.balance }}</div>
          <small class="text-uppercase font-weight-bold">Wallet: {{ wallet.no_wallet }}</small>
          <b-progress height={} class="progress-xs mt-3 mb-0" variant="info" :value="0"/>
        </b-card>
      </b-col>

      <!-- transaction -->
      <b-col sm="12" md="12" lg="12">
        <b-card header="Transaction">
          <b-table responsive="sm" :items="transaction" :fields="tableFields">
          </b-table>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Wallet',
  data(){
    return {
      tableFields: [
        {
          key: 'no_trans',
          label: 'No. Trans',
          sortable: true
        },
        {
          key: 'note',
          sortable: true
        },
        {
          key: 'type',
          sortable: true
        },
        {
          key: 'amount',
          sortable: true
        },
      ],
    }
  },
  created(){
    if(this.profileStat == 'success'){
      this.fetchWallet();
    }
  },
  watch: {
    profileStat(value){
      if(value === 'success'){
        this.fetchWallet();
      }
    },
    walletStat(value){
      if(value === 'success'){
        this.fetchTransaction();
      }
    }
  },
  methods: {
    fetchWallet(){
      this.$store.dispatch('wallet/getBalance',this.profile.id);
    },
    fetchTransaction(){
      this.$store.dispatch('transaction/index',this.wallet.no_wallet);
    }
  },
  computed: {
    ...mapGetters('user',{
      profile: 'profile',
      profileStat: 'profileStat'
    }),
    ...mapGetters('wallet',{
      wallet: 'wallet',
      walletStat: 'walletStat'
    }),
    ...mapGetters('transaction',{
      transaction: 'dataS',
      transactionStat: 'dataStatS'
    })
  }
}
</script>
