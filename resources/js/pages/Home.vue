<template>
  <div class="h-screen p-8 md:p-16">
    <div class="flex justify-between">
      <h1 class="text-2xl font-bold text-blue-800">Welcome, {{ user.username }}</h1>
      <button @click="logout"  class="bg-transparent hover:bg-blue-800 text-blue-800 font-semibold hover:text-white py-4 px-6 border border-blue-500 hover:border-transparent rounded">
        Logout
      </button>
    </div>

    <div v-if="user.user_type === 'Admin'">
      <HomeAdmin/>
    </div>
    <div v-else-if="user.user_type === 'User'">
      <HomeUser @logout="logout"/>
    </div>
  </div>
</template>

<script>
import HomeAdmin from '../components/Home-Admin.vue';
import HomeUser from '../components/Home-User.vue';

export default {
  components: {
    HomeAdmin,
    HomeUser
  },
  data() {
    return {
      user: {}
    }
  },
  methods: {
    logout(){
      this.$axios.get('/sanctum/csrf-cookie')
        .then(response => {
          this.$axios.post('api/logout', this.user)
            .then(response => {
              if (response.data.success) {
                window.location.href = "/";
              } else {
                console.log(response.data);
              }
            })
            .catch(error => {
              console.log(error);
            });
        });
    }
  },
  mounted() {
    if(window.Laravel.user){
      this.user = window.Laravel.user;
    }
  },
  beforeRouteEnter(to, from, next){
    if(!window.Laravel.isLoggedin){
      return next({name: 'Login'});
    }
    next();
  }
}

</script>

<style>

</style>