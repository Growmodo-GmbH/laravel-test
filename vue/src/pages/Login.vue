<template>
    <div class="flex h-screen flex-col justify-center items-center px-6 py-12 lg:px-8 bg-indigo-300">
      <div class="shadow-xl sm:w-full sm:max-w-sm rounded-lg p-10 bg-white">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Log in to your account</h2>
          </div>
        
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit="login">
              <!-- error message -->
              <p class="text-red-600 italic" v-if="errorMsg">{{ errorMsg }}</p>
              <!-- username/email -->
              <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username/Email address</label>
                <div class="mt-2">
                  <input id="username" name="username" type="text" placeholder="johndoe@email.com" v-model="user.username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>
        
              <div>
                <!-- password -->
                <div class="flex items-center justify-between">
                  <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                  <input id="password" name="password" type="password" placeholder="******" v-model="user.password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>
        
              <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
              </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Create an account</a>
            </p>
          </div>
      </div>
    </div>
</template>
    
<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import axios from 'axios';
import store from '../store';

const router = useRouter();

const user = {
  username: '',
  password: ''
};

let errorMsg = ref('');

function login(e) {
  e.preventDefault();

  store.dispatch('login', user)
    .then((res) => {
      if (res.response && res.response.data !== undefined) {
        errorMsg.value = res.response.data.error;
      }else{
        router.push({
          name: 'Home'
        })
      }
    })
}
</script>