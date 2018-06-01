<template>
  <div class="app flex-row align-items-center animated fadeIn">
    <div class="container">
      <b-row class="justify-content-center">

        <!-- loading -->
        <b-col md="6" sm="6" v-if="state == 'loading'">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <h1>Registering...</h1>
            </b-card-body>
          </b-card>
        </b-col>

        <!-- not loading -->
        <b-col md="6" sm="8" v-else>

          <!-- alert -->
          <b-alert :show="alertDismissCountDown" variant="danger" dismissible @dismiss-count-down="alertCountDownChanged">{{alertMessage}}</b-alert>
          
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>@</b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Email" v-model="email" >
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>First Name</b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="First Name" v-model="first_name" >
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>Last Name</b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Last Name" v-model="last_name" >
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text><i class="icon-phone"></i></b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Mobile" v-model="mobile" >
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text><i class="icon-lock"></i></b-input-group-text> 
                </b-input-group-prepend>
                <input type="password" class="form-control" placeholder="Password" v-model="password">
              </b-input-group>

              <b-input-group class="mb-4">
                <b-input-group-prepend>
                  <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                </b-input-group-prepend>
                <input type="password" class="form-control" placeholder="Repeat password" v-model="c_password">
              </b-input-group>

              <b-button variant="success" @click.prevent="register()" block>Create Account</b-button>
            </b-card-body>
            <b-card-footer class="p-4">
              <b-row>
                <b-col cols="4">
                  <b-link class="btn btn-danger btn-block" to="/user/login"><span>< back</span></b-link>
                </b-col>
                <b-col cols="4">
                  <b-button block class="btn btn-facebook"><span>facebook</span></b-button>
                </b-col>
                <b-col cols="4">
                  <b-button block class="btn btn-twitter" type="button"><span>twitter</span></b-button>
                </b-col>
              </b-row>
            </b-card-footer>
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
      first_name: '',
      last_name: '',
      mobile: '',
      password: '',
      c_password: ''
    }
  },
  mounted() {
    document.addEventListener("keydown", (e) => {
      if (e.keyCode == 13) {
        this.register();
      }
    });
  },
  methods: {
    register(){
      let data = {
        email: this.email,
        first_name: this.first_name,
        last_name: this.last_name,
        mobile: this.mobile,
        password: this.password,
        c_password: this.c_password
      };

      this.state = 'loading';
      axios.post('/api/register', data)
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
