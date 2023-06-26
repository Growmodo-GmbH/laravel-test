<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img class="logo" src="../assets/images.png">
            </div>
            <div class="col-md-12" style="padding-top: 35px;">
                <button @click="$router.push('/')" type="button" class="btn btn-success" style="float: left;">Back to Dashboard</button>
                <button @click.prevent="handleLogout" type="button" class="btn btn-danger" style="float: right;">Log Out</button>
            </div>
            <div class="col-md-12">
            <h1>User List</h1>
            <div class="table-responsive">
              <table class="table">
              <thead>
                  <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email Address</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="user in result.users" v-bind:key="user.id">
                      <td>{{ user.id }}</td>
                      <td>{{ user.username }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.phone_number }}</td>
                      <td>
                        <button @click.prevent="handleEdit(user.id)" type="button" class="btn btn-warning">Update</button>
                        <button @click.prevent="handleDelete(user.id)" type="button" class="btn btn-danger">Delete</button>
                      </td>
                  </tr>
              </tbody>
              </table>
            </div>
            <span class="error">{{ errorMessage }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

Vue.use(axios)

export default {
  name: 'Users',
  data () {
    return {
      result: {},
      users: {
        id: '',
        username: '',
        email: '',
        phone_number: ''
      },
      token: localStorage.getItem('token')
    }
  },
  created () {
    axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
    this.LoadUsers()
  },
  methods: {
    LoadUsers: function () {
      axios.get('http://127.0.0.1:8000/api/admin/users')
        .then(
          response => {
            console.log(response)
            this.result = response.data
          }
        )
        .catch(
          errors => {
            if (errors.response.status === 401 || errors.response.status !== 200) {
              localStorage.removeItem('token')
              this.$router.push({ name: 'Login' })
            }
          }
        )
    },
    handleLogout () {
      axios.post('http://127.0.0.1:8000/api/logout', this.token)
        .then(
          response => {
            console.log(response)
            localStorage.removeItem('token')
            this.$router.push({ name: 'Login' })
          }
        )
    },
    handleEdit (ID) {
      localStorage.setItem('ID', ID)
      this.$router.push({ name: 'EditUser' })
    },
    handleDelete (ID) {
      axios.post('http://127.0.0.1:8000/api/delete/' + ID)
        .then(
          response => {
            this.errorMessage = 'User has been deleted!'
            window.location.reload()
          }
        )
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
    font-weight: normal;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin: 0 10px;
}

a {
    color: #42b983;
}

.logo {
    width: 190px;
    max-width: 172px;
}
</style>
