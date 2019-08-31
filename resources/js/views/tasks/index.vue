<template>
  <div>
    <div class="container mb-5 mt-5">
      <div class="card mb-2" v-for="task in tasks" v-bind:key="task.id">
        <div class="card-body pb-0" style="padding:10px">
          <router-link :to="{name: 'task', params: {id: task.id}}">
            <h4 class="card-title">{{ task.name }}</h4>
          </router-link>

          <!-- <p class="card-text">{{ task.details }}</p> -->
        </div>
      </div>

      <div v-show="showLoading" style="margin-top:20%">
        <p class="text-center">loading...</p>
      </div>
    </div>
  </div>
</template>

<script>
import { async } from "q";
import Axios from "axios";
export default {
  data() {
    return {
      tasks: [],
      meta: {},
      links: {},
      showLoading: true
    };
  },

  computed: {
    token() {
      return this.$store.state.accessToken;
    }
  },

  created() {
    if (this.token=='') {
      this.$router.push('/login')
    }
    this.getTasks();
    // console.log(this.token)
  },
  methods: {
    async getTasks() {
      let header = {
        headers: {
          "Authorization":this.token,
          "Content-Type": "application/json",
          "Accept": "application/json"
        }
      };

      await Axios.get("/todo/tasks", header)
        .then(res => {
          this.tasks = res.data.data;
        })
        // .then(res => {
        //   console.log(this.tasks);
        // })
        .catch(error => {
          console.log(error.request.status);
          if (error.request.status == 401) {
            this.$router.push("/login");
          }
        });
      this.showLoading = false;
    }
  }
};
</script>