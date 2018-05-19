<template>
  <div>
    this is header
  </div>
</template>

<script>
export default {
  data(){
    return {
      authenticated: auth.check(),
      user: auth.user
    }
  },
  mounted() {
      Event.$on('userLoggedIn', () => {
          this.authenticated = true;
          this.user = auth.user;
      });
  },
  methods: {
    
  }
}
</script>
