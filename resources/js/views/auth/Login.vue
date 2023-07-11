<template>
  <div>
    <h1 class="font-bold text-indigo-500 text-center text-lg mb-2 uppercase">Growmodo's Trial Challenge</h1>
    <h1 class="text-3xl font-bold text-center text-gray-700 uppercase">Login</h1>
    <p v-if="errors['error']" class="text-red-500 font-semibold text-sm text-center mt-5 mb-2">{{ errors.error }}</p>

    <form class="space-y-4" @submit.prevent="login()">
        <div>
            <label class="label">
                <span class="text-base label-text">Email</span>
            </label>
            <input name="email" v-model="user.email" type="text" placeholder="Enter email" autocomplete="email" class="w-full input input-bordered" />
            <p v-if="errors['email']" class="text-red-500 text-xs font-semibold">{{ errors['email'][0] }}</p>
        </div>
        <div>
            <label class="label">
                <span class="text-base label-text">Password</span>
            </label>
            <input name="password" v-model="user.password" type="password" placeholder="Enter password" autocomplete="password" class="w-full input input-bordered" />
            <p v-if="errors['password']" class="text-red-500 text-xs font-semibold">{{ errors['password'][0] }}</p>
        </div>
        <div>
            <button class="btn btn-block">Sign In</button>
        </div>
        <p class="mt-10 text-center text-sm text-gray-500">
          Not a user?
          <router-link :to="{name: 'Register'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Create an account</router-link>
        </p>
      </form>
  </div>
</template>

<script>
import store from '../../store';

export default {
  data() {
    return {
      user: {
        email: '',
        password: '',
      },
      errors: [],
    }
  },
  methods: {
    login() {
      store.dispatch('login', this.user)
        .then(() => {
          window.location.replace('http://127.0.0.1:8000/welcome')
        }).catch(error => {
          if (error.response.data.error) {
            this.errors = [];
            this.errors['error'] = error.response.data.error;
          } else {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
}
</script>
