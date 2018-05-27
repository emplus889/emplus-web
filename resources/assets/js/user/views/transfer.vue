<template>
  <div class="animated fadeIn">
    <!-- alert -->
    <b-alert show variant="primary" v-if="updateStat == 'success'">{{updateResponse.message}}</b-alert>
    <b-alert show variant="danger" v-else-if="updateStat == 'fail'">{{updateResponse.message}}</b-alert>

    <!-- if loading transfer -->
    <b-row v-if="updateStat == 'loading'">
      <b-col>
        <b-card>
          Loading...
        </b-card>
      </b-col>   
    </b-row>

    <!-- if not loading transfer -->
    <b-row v-else>
      <b-col sm="12" md="12" lg="12">
        <b-card>
          <!-- header -->
          <div slot="header">
            Transfer
          </div>

          <!-- body -->
          <b-row>
            <b-col sm="12">
              <b-form-group>
                <label for="no_wallet_origin">Your Wallet</label>
                <b-form-input type="text" id="no_wallet_origin" placeholder="Enter destination wallet number" v-model="form.no_wallet_origin"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="no_wallet_destination">Destination No. Wallet</label>
                <b-form-input type="text" id="no_wallet_destination" placeholder="Enter destination wallet number" v-model="form.no_wallet_destination"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="amount">Amount</label>
                <b-form-input type="text" id="amount" placeholder="Enter amount you want to transfer" v-model="form.amount"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="note">Note (Optional)</label>
                <b-form-input type="text" id="note" placeholder="Enter transfer note" v-model="form.note"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <!-- footer -->
          <div slot="footer">
            <b-button type="submit" size="sm" variant="primary" @click.prevent="send()"><i class="fa fa-dot-circle-o"></i> Send</b-button>
            <b-button type="reset" size="sm" variant="danger" @click.prevent="reset()"><i class="fa fa-ban"></i> Reset</b-button>
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
      form:{
        no_wallet_origin:'',
        no_wallet_destination:'',
        amount:0,
        note:'',
      }
    }
  },
  watch: {
    updateStat(value){
      if(value == 'success'){
        this.reset();
      }else if(value == 'loading'){

      }else{

      }
    }
  },
  methods: {
    send(){
      this.$store.dispatch('wallet/transferBalance',this.form);
    },
    reset(){
      this.form.no_wallet_origin = '';
      this.form.no_wallet_destination = '';
      this.form.amount = 0;
      this.form.note = '';
    }
  },
  computed: {
    ...mapGetters('wallet',{
				updateResponse: 'update',
				updateStat: 'updateStat'
			}),
  }
}
</script>
