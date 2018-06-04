<template>
  <div class="animated fadeIn">
    <!-- alert -->
    <b-alert :show="alertDismissCountDown" :variant="alertType" dismissible @dismissed="alertDismissed" @dismiss-count-down="alertCountDownChanged">{{alertMessage}}</b-alert>

    <!-- if loading transfer -->
    <b-row v-if="updateStat == 'loading' || confirmDataStat == 'loading'">
      <b-col>
        <b-card>
          Loading..
        </b-card>
      </b-col>   
    </b-row>

    <!-- if not loading transfer -->
    <b-row v-else>
      <!-- transfer form -->
      <b-col sm="12" v-if="state == 'transfer'">
        <b-card>
          <!-- header -->
          <div slot="header">
            Transfer
          </div>

          <!-- body -->
          <b-row>
            <b-col sm="12">
              <b-form-group>
                <label for="no_wallet_origin">No. Dompet Anda</label>
                <b-form-select type="text" id="no_wallet_origin" v-model="form.no_wallet_origin">
                  <template slot="first">
                    <option :value="null" disabled>Silahkan memilih dompet</option>
                  </template>
                  <option :value="wallet.no_wallet" selected>{{wallet.no_wallet}}</option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="no_wallet_destination">No. Dompet Tujuan</label>
                <b-form-input type="text" id="no_wallet_destination" placeholder="Masukkan no dompet tujuan" v-model="form.no_wallet_destination"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="amount">Jumlah</label>
                <b-form-input type="number" id="amount" placeholder="Masukkan jumlah transfer" v-model="form.amount"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="note">Catatan (Opsional)</label>
                <b-form-input type="text" id="note" placeholder="Masukkan Catatan" v-model="form.note"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <!-- footer -->
          <div slot="footer">
            <b-button type="submit" size="sm" variant="primary" @click.prevent="confirm()"><i class="fa fa-dot-circle-o"></i> Confirm</b-button>
            <b-button type="reset" size="sm" variant="danger" @click.prevent="reset()"><i class="fa fa-ban"></i> Reset</b-button>
          </div>
        </b-card>
      </b-col>

      <!-- transfer confirm -->
      <b-col sm="12" v-else-if="state == 'confirm'">
        <b-card>
          <!-- header -->
          <div slot="header">
            Transfer Confirm
          </div>

          <!-- body -->
          <b-row>
            <b-col sm="12">
              <h3>Apakah data tujuan transfer anda benar?</h3>
              <hr>
              <b-form-group>
                <label for="name">Nama Tujuan Transfer</label>
                <b-form-input type="text" id="first_name" disabled v-model="confirmData.user.first_name"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="no_wallet_destination">No. Tujuan Transfer</label>
                <b-form-input type="text" id="no_wallet_destination" v-model="form.no_wallet_destination" disabled></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="amount">Jumlah</label>
                <b-form-input type="number" id="amount" v-model="form.amount" disabled></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="note">Catatan (Opsional)</label>
                <b-form-input type="text" id="note" v-model="form.note" disabled></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <!-- footer -->
          <div slot="footer">
            <b-button type="submit" size="sm" variant="primary" @click.prevent="send()"><i class="fa fa-dot-circle-o"></i> Send</b-button>
            <b-button type="reset" size="sm" variant="danger" @click.prevent="back()"><i class="fa fa-ban"></i> Back</b-button>
          </div>
        </b-card>
      </b-col>
      
    </b-row>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Transfer',
  data(){
    return {
      state:'transfer',
      alertType: '',
      alertMessage: '',
      alertDismissSecs: 5,
      alertDismissCountDown: 0,
      form:{
        no_wallet_origin:null,
        no_wallet_destination:null,
        amount:null,
        note:null,
      }
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
        this.form.no_wallet_origin = this.wallet.no_wallet;
      }
    },
    confirmDataStat(value){
      if(value == 'success'){
        this.state = 'confirm';
      }else if(value == 'fail'){
        this.state = 'transfer';
        this.alertShow('danger',this.confirmData);
      }
    },
    updateStat(value){
      if(value == 'success'){
        this.reset();
        this.state = 'transfer';
        this.alertShow('primary',this.updateResponse.message);
      }else if(value == 'loading'){

      }else if(value == 'fail'){
        this.state = 'transfer';
        this.alertShow('danger',this.updateResponse.message);
      }
    }
  },
  methods: {
    fetchWallet(){
      this.$store.dispatch('wallet/getBalance',this.profile.id);
    },
    confirm(){
      this.$store.dispatch('wallet/checkWalletNo',this.form);
    },
    back(){
      this.state = 'transfer';
    },
    send(){
      this.$store.dispatch('wallet/transferBalance',this.form);
    },
    reset(){
      this.form.no_wallet_destination = '';
      this.form.amount = 0;
      this.form.note = '';
    },
    alertCountDownChanged(alertDismissCountDown){
      this.alertDismissCountDown = alertDismissCountDown
      if(this.alertDismissCountDown <= 0){
        this.alertDismissed();
      } 
    },
    alertShow(type,message){
      this.alertType = type;
      this.alertMessage = message;
      this.alertDismissCountDown = this.alertDismissSecs
    },
    alertDismissed(){
      this.$store.dispatch('wallet/resetUpdateStat');
    }
  },
  computed: {
    ...mapGetters('user',{
      profile: 'profile',
      profileStat: 'profileStat'
    }),
    ...mapGetters('wallet',{
      wallet: 'wallet',
      walletStat: 'walletStat',
      confirmData: 'data',
      confirmDataStat: 'dataStat',
      updateResponse: 'update',
      updateStat: 'updateStat'
    }),
  }
}
</script>
