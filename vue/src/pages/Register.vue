<template>
  <div class="flex h-screen flex-col justify-center items-center px-6 py-12 lg:px-8 bg-indigo-300">
    <div class="shadow-xl rounded-lg p-10 bg-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create an account</h2>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" @submit="register">
            <!-- error message -->
            <span>
              <span v-for="(type, index) in errorMsg" :key="index">
                <p class="text-red-600 italic" v-for="(error, ndx) in type" :key="ndx">{{ error }}</p>
              </span>
            </span>
            <!-- username -->
            <div>
              <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
              <div class="mt-2">
                <input id="username" name="username" type="text" placeholder="johndoe123" v-model="user.username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
            <!-- email address -->
            <div>
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" placeholder="johndoe@email.com" v-model="user.email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <!-- phone number -->
            <div>
              <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
              <div class="mt-2">
                <input id="phone_number" name="phone_number" type="tel" placeholder="0912-345-6789" v-model="user.phone_number" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
              <!-- password -->
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                  <input id="password" name="password" type="password" placeholder="******" v-model="user.password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>
              <!-- confirm password -->
              <div class="w-full md:w-1/2 px-3">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                <div class="mt-2">
                  <input id="password_confirmation" name="password_confirmation" type="password" placeholder="******" v-model="user.password_confirmation" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>
            </div>

            <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
            </div>
          </form>

          <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
            <a href="/" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Log in to your account</a>
          </p>
        </div>
    </div>
  </div>
</template>
  
<script setup>
import store from '../store';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import axios from 'axios';

const router = useRouter();

const user = {
  username: '',
  email: '',
  phone_number: '',
  password: '',
  password_confirmation: ''
};

let errorMsg = ref([]);

function register(e) {
  e.preventDefault();

  store.dispatch('register', user)
  .then((res) => {
    if (res.response && res.response.data !== undefined) {
      errorMsg.value = Object.values(res.response.data.errors);
    } else {
      router.push({
        name: 'Home'
      });
    }
  });


}
</script>