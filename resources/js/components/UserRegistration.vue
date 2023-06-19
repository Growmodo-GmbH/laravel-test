<template>
  <div class="container">
    <h2>Register</h2>
    <form @submit="submitForm">
      <div class="mb-3">
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email">Email Address:</label>
        <input type="email" id="email" v-model="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" v-model="phone" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" v-model="confirmPassword" class="form-control" required>
        <div v-if="password !== confirmPassword" class="text-danger">
          Passwords do not match.
        </div>
      </div>
      <div v-if="errorMessage" class="text-danger">
        {{ errorMessage }}
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      username: '',
      email: '',
      phone: '',
      password: '',
      confirmPassword: '',
      errorMessage: '',
    };
  },
  methods: {
    submitForm(event) {
      event.preventDefault();

      if (this.password !== this.confirmPassword) {
        // Password match validation failed
        // Display an error message or handle the validation error as needed
        alert('The passwords do not match.');
        return;
      }

      const userData = {
        username: this.username,
        email: this.email,
        phone_number: this.phone,
        password: this.password,
        confirm_password: this.confirmPassword,
      };

      // Send the registration data to the backend API
      axios
        .post('/register', userData)
        .then(response => {
          // Handle successful registration
          console.log('Registered successfully');

          // Redirect the user to the login page with a success message
          this.$router.push({
            name: 'login',
            params: { successMessage: 'Registration successful. You can now login using your credentials.' }
          });
        })
        .catch(error => {
          // Handle registration error
          console.error('Registration error:', error);

          // Check if the error is an instance of Error
          if (error instanceof Error) {
            // Display a generic error message
            this.errorMessage = 'An error occurred during registration.';
          } else if (error.response && error.response.data && error.response.data.message) {
            // Display the error message returned from the server
            this.errorMessage = error.response.data.message;
          } else {
            // Handle other types of errors as needed
            this.errorMessage = 'An error occurred during registration.';
          }
        });
    },
  },
};
</script>
