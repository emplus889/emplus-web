<template>
  <div class="app flex-row align-items-center animated fadeIn">
    <div class="container">
      <b-row class="justify-content-center">

        <!-- loading -->
        <b-col md="8" v-if="state == 'loading'">
          <b-card no-body class="text-white bg-primary py-5 d-lg-none d-xl-none d-md-down-block">
            <b-card-body class="text-center">
              <div>
                <h2>Login...</h2>
              </div>
            </b-card-body>
          </b-card>
        </b-col>

        <!-- not loading -->
        <b-col md="8" v-else>
          
          <!-- alert -->
          <b-alert :show="alertDismissCountDown" variant="danger" dismissible @dismiss-count-down="alertCountDownChanged">{{alertMessage}}</b-alert>
      
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
                  <input type="password" class="form-control" placeholder="Password" v-model="password">
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
      state: '',
      alertMessage: '',
      alertDismissSecs: 5,
      alertDismissCountDown: 0,
      authenticated: auth.check(),
      email: '',
      password: ''
    }
  },
  mounted() {
    document.addEventListener("keydown", (e) => {
      if (e.keyCode == 13) {
        this.login();
      }
    });
  },
  methods: {
    login(){
      let data = {
        email: this.email,
        password: this.password
      };
      
      this.state = 'loading';
      axios.post('/api/login', data)
        .then(({data}) => {
          this.state = 'success';
          auth.login(data.token, data.user);
          this.$router.push('/user');
        })  
        .catch(({response}) => {  
          this.state = 'error';
          this.alertShow(response.data.message);
        });
    },
    // for alert
    alertCountDownChanged(alertDismissCountDown){
      this.alertDismissCountDown = alertDismissCountDown
    },
    alertShow(message){
      this.alertMessage = message;
      this.alertDismissCountDown = this.alertDismissSecs
    }
  }
}
</script>
