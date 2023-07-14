<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form @submit.prevent="createUser">
                        <p v-if="errors.length">
                            <span v-for="error in errors">{{ error }}</span>
                        </p>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="username" v-model="userData.username" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" v-model="userData.email" type="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" v-model="userData.phone" type="tel" class="form-control" name="phone" required autocomplete="phone">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" v-model="userData.password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" v-model="userData.passwordConfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                Already have an account?<a class="btn-link" href="/login">Log in</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
        errors: [],
        userData: {
            username: '',
            email:  '',
            phone:   '',
            password: '',
            passwordConfirm: '',
        }
    }
  },
  methods: {
    createUser() {
        this.errors = [];
        if (this.userData.password == this.userData.passwordConfirm) {
            axios.post('/api/v1/users', this.userData)
                .then(window.location.href = "/")
                .catch(error => console. log(error) );
        }
        else {
            this.errors.push('Password do not match');
        }
        e.preventDefault();
    }
  }
}
</script>