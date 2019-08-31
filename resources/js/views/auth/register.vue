<template>
  <div>
    <div class="container register">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-center">Register</div>

            <div class="card-body">
              <form @submit.prevent="registerSubmit">
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                  <div class="col-md-6">
                    <input class="form-control" type="text" required autocomplete="name" autofocus />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                  <div class="col-md-6">
                    <input
                      class="form-control"
                      id="email"
                      type="email"
                      required
                      autocomplete="email"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                  <div class="col-md-6">
                    <input
                      class="form-control"
                      type="password"
                      required
                      autocomplete="new-password"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label
                    for="password-confirm"
                    class="col-md-4 col-form-label text-md-right"
                  >Confirm password</label>

                  <div class="col-md-6">
                    <input
                      class="form-control"
                      type="password"
                      required
                      autocomplete="new-password"
                    />
                  </div>
                </div>
                <div class="container">
                  <p class="text-center">
                    <router-link to="/login">Already have an account?</router-link>
                  </p>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                  </div>
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
export default {
    methods:{
        registerSubmit(){
            console.log('registered');
        }
    }
};
</script>
<style scoped>
.register {
  margin-top: 10%;
}
</style>