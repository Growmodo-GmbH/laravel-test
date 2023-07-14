<template>
  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">Hello, {{ getUser.data.username }}!</h1>
        <p class="py-6">Welcome to Growmodo's User Registration App.</p>
        <template v-if="getUser.data.is_admin">
          <router-link :to="{ name: 'Users' }">
            <button class="btn btn-neutral mr-10">View User Records</button>
          </router-link>
        </template>
        <template v-else>
          <button class="btn btn-neutral mr-10">Unsubscribe</button>
        </template>
        <button @click="logout()" class="btn btn-neutral">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store';

export default {
  methods: {
    logout() {
      store.dispatch('logout')
        .then(() => {
          this.$router.push({
            name: 'Login'
          });
        });
    }
  },
  computed: {
    getUser() {
      return store.getters.getUser;
    }
  }
}
</script>
