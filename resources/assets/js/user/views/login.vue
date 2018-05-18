<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>

            <form @submit.prevent="login()">
            <v-card class="elevation-12">
              <!-- header -->
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar>
              <!-- body -->
              <v-card-text>
                
                  <!-- email -->
                  <v-text-field 
                    prepend-icon="mail" 
                    name="email" 
                    label="Email" 
                    id="email"
                    type="email"
                    class="input-group--focused"
                    v-model="email"
                    ></v-text-field>

                  <!-- password -->
                  <v-text-field 
                    prepend-icon="lock"
                    id="password"  
                    name="password" 
                    label="Password" 
                    type="password"
                    v-model="password"
                    ></v-text-field>
              </v-card-text>
              <!-- button -->
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" type="submit">Login</v-btn>
              </v-card-actions>
            </v-card>
            </form>
             
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data(){
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login(){
      axios.post('/login', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          this.$router.push('/user');
        }).catch(error => {
          console.log(error.response)
        });
      console.log('yo')  
    },
  }
}
</script>
