<template>
  <div class="rounded-lg p-12 text-center">
    <h1 class="mb-5 text-4xl font-medium text-slate-700 dark:text-slate-100">
      Welcome,
      <router-link
        :to="{ name: 'login' }"
        class="font-bold text-red-500 transition duration-200 ease-in-out hover:text-red-700 focus:text-red-700"
      >
        Sign In
      </router-link>
      or
      <router-link
        :to="{ name: 'register' }"
        class="font-bold text-red-500 transition duration-200 ease-in-out hover:text-red-700 focus:text-red-700"
      >
        Sign Up
      </router-link>
    </h1>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Home',
  components: {},
  props: {},
  data() {
    return {};
  },
  computed: {},
};
</script>
