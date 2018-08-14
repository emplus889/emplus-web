<template>
  <b-nav-item-dropdown right no-caret>
    <template slot="button-content">
      <img src="/images/no_image_man.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
    </template>
    <b-dropdown-header tag="div" class="text-center"><strong>Hi, {{profile.first_name}}</strong></b-dropdown-header>
    <b-dropdown-item><i class="fa fa-user"></i> Account</b-dropdown-item>
    <b-dropdown-item><i class="fa fa-wrench"></i> Application</b-dropdown-item>
    <b-dropdown-divider></b-dropdown-divider>
    <b-dropdown-item @click.prevent="logout()"><i class="fa fa-lock"></i> Logout</b-dropdown-item>
  </b-nav-item-dropdown>
</template>
<script>
import { mapGetters } from 'vuex';

export default { 
  name: 'header-dropdown',
  data: () => {
    return { itemsCount: 42 }
  },
  methods: {
    logout(){
      auth.logout();
      this.$router.push('/user/login');
    }
  },
  computed: {
    ...mapGetters('user',{
      profile: 'profile',
      profileStat: 'profileStat'
    })
  }
}
</script>
