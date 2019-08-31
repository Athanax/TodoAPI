<template>
  <div>
    <div class="container login">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-center">Login</div>

            <div class="card-body">
              <form @submit.prevent="submitLogin">
                <div v-show="errors.noAccount">
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Please check your login credentials</strong>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                  <div class="col-md-6">
                    <input
                      v-model="username"
                      class="form-control"
                      type="text"
                      v-on:keyup="usernameError"
                      :class="errors.username"
                      autocomplete="email"
                      autofocus
                    />
                    <span class="ml-1" v-show="errors.username!=''">
                      <span class="text-danger">Username is required</span>
                    </span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                  <div class="col-md-6">
                    <input
                      v-model="password"
                      class="form-control"
                      :class="errors.password"
                      type="password"
                      v-on:keyup="passwordError"
                      id
                      autocomplete="current-password"
                    />
                    <span class="ml-1" v-show="errors.password!=''">
                      <span class="text-danger">Password is required</span>
                    </span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                      <label class="form-check-label" for="remember">Remember me?</label>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
                </div>
                <div class="container">
                  <p class="text-center">
                    <router-link to="/register">Do not have an account?</router-link>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { setTimeout } from "timers";
export default {
  data() {
    return {
      username: "",
      password: "",
      client: [],
      errors: {
        username: "",
        password: "",
        noAccount: false
      }
    };
  },
  computed: {
    token() {
      return this.$store.state.accessToken;
    }
  },
  mounted(){
	  this.checkToken()
  },

  created() {
    

    getClient: {
      Axios.get("/todo/client")
        .then(res => {
          this.client = res.data.data;
        })
        // .then(res => {
        //   console.log();
        // })
        .catch(error => {
          console.log(error);
        });
    }
    
  },

  methods: {
    submitLogin() {
      let data = {
        grant_type: "password",
        client_id: this.client.clientId,
        client_secret: this.client.clientSecret,
        username: this.username,
        password: this.password
      };

      // console.log(this.client.clientId);
      Axios.post("/oauth/token", data)
        .then(res => {
          // console.log(res.data.access_token);

          // this.$store.dispatch("setTokenAction", res.data.access_token);
          this.$store.commit('setToken', 'Bearer '+res.data.access_token);
		//   console.log(this.$store.state.accessToken);
		
			this.checkToken();
        })
        .catch(errors => {
          if (errors.request.status == 400) {
            if (errors.response.data.hint == "Check the `username` parameter") {
              this.errors.username = "is-invalid";
            } else if (
              errors.response.data.hint == "Check the `password` parameter"
            ) {
              this.errors.password = "is-invalid";
            }
          } else if (errors.request.status == 401) {
            console.log(errors.response.data);
            this.errors.noAccount = true;
          } else {
            console.log(errors);
          }
          // console.log(errors.request.status);
          // console.log(errors.response.data);
        });
    },

    usernameError() {
      this.errors.username = "";
      this.errors.noAccount = false;
    },
    passwordError() {
      this.errors.noAccount = false;
      this.errors.password = "";
	},
	
	checkToken(){
		// console.log(this.token)
		if (this.token!='') {
			this.$router.push('/tasks')
		}
	}
  }
};
</script>
<style scoped>
.login {
  margin-top: 10%;
}
</style>