<template>
  <div>
    <div v-show="reqStatus" style="margin-top:20%">
      <p class="text-center">loading...</p>
    </div>

    <div class="container mt-5 mb-5">
      <div class="card text-center">
        <div class="card-body">
          <h4 class="card-title">{{ task.name }}</h4>
          <p class="card-text">{{ task.details }}</p>
        </div>
        <div class="container mb-5">
          <button @click="editTask" class="btn btn-primary">Edit</button>
          <button @click="deleteTask" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      task: [],
      reqStatus: true,
      
    };
  },
  computed: {
    token() {
      return this.$store.state.accessToken;
    }
  },

  created() {
    this.getTask();
  },

  methods: {
    async getTask() {
      let header= {
        headers: {
          Authorization: this.token,
          "Content-Type": "application/json",
          Accept: "application/json"
        }
      };
      await Axios.get("/todo/tasks/" + this.$route.params.id, header)
        .then(res => {
          // console.log(res.data.data);
          this.task = res.data.data;
          // console.log(this.task)
          this.reqStatus = false;
        })
        .catch(errors => {
          console.log(errors)
        });
    },

    // delete task

    
    editTask() {
      this.$router.push({name: 'edit', params: {id: this.$route.params.id }})
    },
    async deleteTask() {
      let header= {
        headers: {
          Authorization: this.token,
          "Content-Type": "application/json",
          Accept: "application/json"
        }
      };
      await Axios.delete('/todo/tasks/'+ this.$route.params.id, header)
      .then(this.$router.push('/tasks'))
      .catch(error=>{
        console.log(error)
      })
    },
  }
};
</script>