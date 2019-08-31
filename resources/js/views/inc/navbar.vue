<template>
  <div>
    <nav class="nav mt-2 justify-content-center">
      <router-link to="/">
        <a class="nav-link">Home</a>
      </router-link>

      <router-link v-if="token!=''" to="/create">
        <a class="nav-link">Create</a>
      </router-link>
      <router-link v-if="token!=''" to="/tasks">
        <a class="nav-link">Tasks</a>
      </router-link>

	  <router-link v-if="token==''" to="/login">
         <a  class="nav-link btn btn-link mr-1">Login</a>
      </router-link>

	  <router-link v-if="token==''" to="/register">
        <a  class="nav-link btn btn-link mr-1">Create</a>
      </router-link>

      <a v-if="token!=''" v-on:click="logout" class="nav-link btn btn-primary mr-1">Logout</a>
	 
	  

      <!-- <a class="nav-link disabled" href="#">Disabled link</a> -->
    </nav>
  </div>
</template>

<script>
export default {
  computed: {
    token() {
      return this.$store.state.accessToken;
    }
  },
  methods:{
	  async logout(){
		  await console.log('loging out');
		  this.$store.commit('setToken', '')
	  }
  }
};
</script>
