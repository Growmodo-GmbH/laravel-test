<template>
  <div>
    <h1 class="font-bold text-indigo-500 text-center text-lg mb-3 uppercase">Growmodo's Trial Challenge</h1>
    <h1 class="text-3xl font-bold text-center text-gray-700 uppercase">Register</h1>

    <form class="space-y-4" @submit.prevent="register()">
      <div>
          <label class="label">
              <span class="text-base label-text">Username</span>
          </label>
          <input name="username" type="text" placeholder="Enter username" autocomplete="username" v-model="user.username" class="w-full input input-bordered" />
          <p v-if="errors['username']" class="text-red-500 text-xs font-semibold">{{ errors['username'][0] }}</p>
      </div>
      <div>
          <label class="label">
              <span class="text-base label-text">Email Address</span>
          </label>
          <input name="email" type="text" placeholder="Enter email address" autocomplete="email" v-model="user.email" class="w-full input input-bordered" />
          <p v-if="errors['email']" class="text-red-500 text-xs font-semibold">{{ errors['email'][0] }}</p>
      </div>
      <div>
          <label class="label">
              <span class="text-base label-text">Phone Number</span>
          </label>
          <input name="phone_number" type="text" placeholder="Enter phone number" autocomplete="phone_number" v-model="user.phone_number" class="w-full input input-bordered" />
          <p v-if="errors['phone_number']" class="text-red-500 text-xs font-semibold">{{ errors['phone_number'][0] }}</p>
      </div>
      <div>
          <label class="label">
              <span class="text-base label-text">Password</span>
          </label>
          <input name="password" type="password" placeholder="Enter password" autocomplete="current-password" v-model="user.password" class="w-full input input-bordered" />
          <p v-if="errors['password']" class="text-red-500 text-xs font-semibold">{{ errors['password'][0] }}</p>
      </div>
      <div>
          <label class="label">
              <span class="text-base label-text">Confirm Password</span>
          </label>
          <input name="password_confirmation" type="password" placeholder="Enter confirm password" autocomplete="password_confirmation" v-model="user.password_confirmation"
              class="w-full input input-bordered" />
      </div>
      <div>
          <button class="btn btn-block">Sign Up</button>
      </div>
      <p class="mt-10 text-center text-sm text-gray-500">Already have an account?
          <router-link :to="{name: 'Login'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login to your account</router-link>
      </p>
    </form>
  </div>
</template>

<script>
import store from '../../store'

export default {
  data() {
    return {
      user: {
        username: '',
        phone_number: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      errors: [],
    }
  },
  methods: {
    register() {
      store.dispatch('register', this.user)
        .then(() => {
          window.location.replace('http://127.0.0.1:8000/welcome')
        }).catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
}
</script>