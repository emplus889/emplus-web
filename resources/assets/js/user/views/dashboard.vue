<template>
  <div class="animated fadeIn">
    <b-row>
      <!-- promo carousel -->
      <b-col sm="12" md="12">
        <b-carousel 
          id="carousel1"
          style="text-shadow: 1px 1px 2px #333;"
          controls
          indicators
          background="#ababab"
          :interval="4000"
          img-width="1024"
          img-height="480"
          v-model="slide"
          @sliding-start="onSlideStart"
          @sliding-end="onSlideEnd"
        >
          <b-carousel-slide img-src="https://lorempixel.com/1024/480/technics/2/"></b-carousel-slide>

          <b-carousel-slide img-src="https://lorempixel.com/1024/480/technics/4/"></b-carousel-slide>

          <b-carousel-slide img-src="https://lorempixel.com/1024/480/technics/8/"></b-carousel-slide>

        </b-carousel>
      </b-col>
      <!-- separator -->
      <b-col sm="12" md="12"><hr></b-col>
      <!-- separator -->

      <b-col sm="6" md="4">
        <b-card class="text-white bg-primary">
          <div class="h1 text-right mb-4">
            <i class="icon-wallet"></i>
          </div>
          <div class="h4 mb-0">{{ wallet.balance }}</div>
          <small class="text-uppercase font-weight-bold">Wallet</small>
          <b-progress height={} class="progress-xs mt-3 mb-0" variant="info" :value="0"/>
        </b-card>
      </b-col>
      <b-col sm="6" md="4">
        <b-card class="text-white bg-danger">
          <div class="h1 text-right mb-4">
            <i class="fa fa-exchange"></i>
          </div>
          <div class="h4 mb-0">&nbsp;</div>
          <small class="text-uppercase font-weight-bold">Transfer</small>
          <b-progress height={} class="progress-xs mt-3 mb-0" variant="info" :value="0"/>
        </b-card>
      </b-col>
      <b-col sm="6" md="4">
        <b-card class="text-white bg-warning">
          <div class="h1 text-right mb-4">
            <i class="fa fa-star"></i>
          </div>
          <div class="h4 mb-0">&nbsp;</div>
          <small class="text-uppercase font-weight-bold">Promo</small>
          <b-progress height={} class="progress-xs mt-3 mb-0" variant="info" :value="0"/>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Dashboard',
  data(){
    return {
      slide: 0,
      sliding: null
    }
  },
  watch: {
    profileStat(value){
      if(value === "success"){
        this.$store.dispatch('wallet/getBalance',this.profile.id);
      }
    }
  },
  methods: {
    // carousel
    onSlideStart (slide) {
      this.sliding = true
    },
    onSlideEnd (slide) {
      this.sliding = false
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
    })
  }
}
</script>
