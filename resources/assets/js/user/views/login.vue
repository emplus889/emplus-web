<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            
            <!-- form -->
            <form @submit.prevent="login()">
            <v-card class="elevation-12">
              <!-- header -->
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar>
              <!-- body -->
              <v-card-text>
                
                  <!-- username -->
                  <v-text-field 
                    prepend-icon="mail" 
                    name="username" 
                    label="E-mail" 
                    id="username"
                    type="username"
                    class="input-group--focused"
                    v-model="username"
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
      username: '',
      password: ''
    }
  },
  methods: {
    login(){
      let data = {
        username: this.username,
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
