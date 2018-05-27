<template>
  <div class="app flex-row align-items-center animated fadeIn">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend><b-input-group-text><i class="icon-user"></i></b-input-group-text></b-input-group-prepend>
                  <input type="text" class="form-control" placeholder="Username" v-model="email">
                </b-input-group>
                <b-input-group class="mb-4">
                  <b-input-group-prepend><b-input-group-text><i class="icon-lock"></i></b-input-group-text></b-input-group-prepend>
                  <input type="password" class="form-control" placeholder="Password" v-model="password" >
                </b-input-group>
                <b-row>
                  <b-col cols="6">
                    <b-button variant="primary" class="px-4" @click.prevent="login()">Login</b-button>
                  </b-col>
                  <b-col cols="6" class="text-right">
                    <b-button variant="link" class="px-0">Forgot password?</b-button>
                  </b-col>
                </b-row>
              </b-card-body>
            </b-card>
            <b-card no-body class="text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <b-card-body class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p><b>Don't have an account yet?</b> then don't miss out the future of transaction by clicking register button, and get on the board with us</p>
                  <b-link variant="primary" class="btn btn-warning mt-3" to="/user/register">Register Now!</b-link>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
          <b-card no-body class="text-white bg-primary py-5 d-lg-none d-xl-none d-md-down-block">
              <b-card-body class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p><b>Don't have an account yet?</b> then don't miss out the future of transaction by clicking register button, and get on the board with us</p>
                  <b-link variant="primary" class="btn btn-warning mt-3" to="/user/register">Register Now!</b-link>
                </div>
              </b-card-body>
            </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      authenticated: auth.check(),
      email: '',
      password: ''
    }
  },
  mounted() {
  },
  methods: {
    login(){
      let data = {
        email: this.email,
        password: this.password
      };

      axios.post('/api/login', data)
        .then(({data}) => {
          auth.login(data.token, data.user);
          this.$router.push('/user');
        })  
        .catch(({response}) => {                    
            alert(response.data.message);
        });
    },
  }
}
</script>
