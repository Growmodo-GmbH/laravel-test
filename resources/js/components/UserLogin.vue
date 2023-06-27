<template>
    <div class="container">
        <h2>Login</h2>
        <form @submit="submitForm">
            <div class="mb-3">
                <label for="emailOrUsername">Username/Email:</label>
                <input type="text" id="emailOrUsername" v-model="emailOrUsername" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" id="password" v-model="password" class="form-control" required>
            </div>
            <div v-if="successMessage" class="text-success">
                {{ successMessage }}
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            emailOrUsername: '',
            password: '',
            successMessage: '',
        };
    },
    watch: {
        '$route.params': {
            immediate: true, // Trigger the watcher immediately when the component is created
            handler(params) {
                if (params.successMessage) {
                    this.successMessage = params.successMessage;
                }
            },
        },
    },
    methods: {
        submitForm(event) {
            event.preventDefault();

            // let requestData = {};

            // Check if user input is an email address
            /* if (this.emailOrUsername.includes('@')) {
                requestData = {
                    email: this.emailOrUsername,
                    password: this.password,
                };
            } else {
                requestData = {
                    username: this.emailOrUsername,
                    password: this.password,
                };
            } */

            axios
                .post('/login', {
                    email_or_username: this.emailOrUsername,
                    password: this.password,
                })
                .then(response => {
                    // Handle successful login
                    console.log('Logged in successfully');

                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('user_id', response.data.user_id);
                    localStorage.setItem('user_username', response.data.user_username);
                    localStorage.setItem('user_role', response.data.user_role);

                    // Store username and user role in local storage or Vuex store
                    /* const { username, role } = response.data;

                    localStorage.setItem('username', username);
                    localStorage.setItem('role', role); */

                    // Redirect to the WelcomePage
                    this.$router.push({ name: 'welcome' });
                })
                .catch(error => {
                    // Handle login error
                    console.error('Login error:', error);
                    // Display an error message to the user
                });
        },
    },
};
</script>
  