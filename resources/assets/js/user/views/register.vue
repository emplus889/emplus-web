<template>
  <div class="app flex-row align-items-center animated fadeIn">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
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
                  <b-input-group-text>N</b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Name" v-model="name" >
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
      authenticated: auth.check(),
      email: '',
      name: '',
      mobile: '',
      password: '',
      c_password: ''
    }
  },
  mounted() {
  },
  methods: {
    register(){
      let data = {
        email: this.email,
        name: this.name,
        mobile: this.mobile,
        password: this.password,
        c_password: this.c_password
      };

      axios.post('/api/register', data)
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
