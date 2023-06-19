<template>
  <div class="container d-flex flex-column align-items-center">
    <h1>Welcome, {{ username }}</h1>
    <div class="d-flex justify-content-center mt-3">
      <div v-if="isAdmin" class="me-2">
        <router-link to="/view-records" class="btn btn-primary">View Records</router-link>
      </div>
      <div v-else class="me-2">
        <button @click="unsubscribe" class="btn btn-danger">Unsubscribe</button>
      </div>
      <div>
        <button @click="logout" class="btn btn-secondary">Logout</button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      username: '',
      isAdmin: false,
    };
  },
  mounted() {
    // Retrieve username and role from local storage or Vuex store
    this.username = localStorage.getItem('user_username');

    const role = localStorage.getItem('user_role');

    // Determine if the user is an admin
    this.isAdmin = role === 'admin';
  },
  methods: {
    unsubscribe() {
      // Handle the unsubscribe functionality here
    },
    logout() {
      const userId = localStorage.getItem('user_id');

      axios.post('/logout', { user_id: userId })
        .then(response => {
          // Handle successful logout
          console.log('Logged out successfully');

          // Clear any stored user data from local storage or Vuex store
          localStorage.removeItem('token');
          localStorage.removeItem('user_id');
          localStorage.removeItem('user_username');
          localStorage.removeItem('user_role');

          // Redirect to the login page
          this.$router.push({ name: 'login' });
        })
        .catch(error => {
          // Handle logout error
          console.error('Logout error:', error);
          // Display an error message to the user
        });
    },
  },
};
</script>
