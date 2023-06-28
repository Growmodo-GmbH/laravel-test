<template>
  <div class="h-screen flex justify-center items-center bg-blue-300">
    <div class="w-max mx-4 lg:w-1/3">
      <form @submit="login" class="bg-white shadow-md rounded-md px-8 pt-6 pb-8 mb-4">
        <div class="flex items-center justify-center w-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 text-blue-700">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
          </svg>
        </div>

        <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 my-2 rounded relative" role="alert">
          <span class="block sm:inline">{{ error }}</span>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Username/Email Address
          </label>
          <input v-model="user.login" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input v-model="user.password" class="shadow appearance-none borderrounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Sign In
          </button>
          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/register">
            Create an account?
          </a>
        </div>
      </form>
      <p class="text-center text-gray-500 text-xs">
        &copy;2023 All rights reserved.
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        login: '',
        password: ''
      },
      error: null
    };
  },
  methods: {
    login(e) {
      e.preventDefault();
      this.$axios.get('/sanctum/csrf-cookie')
        .then(response => {
          this.$axios.post('api/login', this.user)
            .then(response => {
              if (response.data.success) {
                window.location.href = "/"
              } else {
                this.error = response.data.message;
              }
            })
            .catch(error => {
              console.log(error);
            });
        });
    }
  },
  beforeRouteEnter(to, from, next){
    if(window.Laravel.isLoggedin){
      return next({name: 'Home'});
    }
    next();
  }
};
</script>

<style>

</style>