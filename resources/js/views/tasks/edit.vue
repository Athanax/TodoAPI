<template>
  <div class="container mb-5 mt-5">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="card-title">Create task</h4>
        <form @submit.prevent="createSubmit" class="container-fluid">
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 col-form-label text-md-right" for="name">Name</label>
              <div class="col-md-6">
                <input
                  v-model="name"
                  :class="nameError"
                  v-on:keyup="clearName()"
                  class="form-control"
                  type="text"
                  id="name"
                />
                <div class="text-left ml-2" v-if="nameError">
                  <strong class="text-danger">Name field is required</strong>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 col-form-label text-md-right" for="description">Description</label>
              <div class="col-md-6">
                <textarea
                  :class="descriptionError"
                  v-model="description"
                  id="description"
                  v-on:keyup="clearDesc()"
                  class="form-control"
                ></textarea>
                <div class="text-left ml-2" v-if="descriptionError !=''">
                  <strong class="text-danger">Description field if required</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="container-fluid">
            <button class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "../../core/Form";
export default {
  data() {
    return {
      task: [],
      name: '',
      description: '',
      nameError: "",
      descriptionError: ""
    };
  },

  computed: {
    token() {
      return this.$store.state.accessToken;
    },
    
  },

  created() {
    if (this.token == "") {
      this.$router.push("/login");
    }
    this.getTask();
    
  },
  methods: {
    async getTask() {
      let header = {
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
          this.name = res.data.data.name;
          this.description = res.data.data.details;
          this.reqStatus = false;
        })
        .catch(errors => {
          this.$router.go(-1);
        });
    },
    async createSubmit() {
      let header = {
        headers: {
          Authorization: this.token,
          "Content-Type": "application/json",
          Accept: "application/json"
        }
      };

      let data = {
        name: this.name,
        description: this.description
      };
      await Axios.put("/todo/tasks/"+this.$route.params.id, data, header)
        .then(res => {
        //   console.log(res.data.data);
          this.$router.push("/tasks/" + res.data.data.id);
        })
        .catch(errors => {
          // console.log(errors.response.data.errors)
          if (errors.response.data.errors.name) {
            this.nameError = "is-invalid";
          }
          if (errors.response.data.errors.description) {
            this.descriptionError = "is-invalid";
          }
        });
    },
    clearName() {
      this.nameError = "";
    },

    clearDesc() {
      this.descriptionError = "";
    }
  }
};
</script>