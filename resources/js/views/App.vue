<template>
  <div class="min-h-screen bg-white dark:bg-slate-800">
    <div id="top_border" />
    <AppNav />
    <div class="w-full">
      <router-view :key="$route.path"></router-view>
    </div>
    <AppToast />
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import AppNav from '@components/AppNav.vue';

export default {
  components: {
    AppNav,
  },
  computed: {
    currentRouteName() {
      return this.$route.name;
    },
  },
  methods: {
    ...mapActions({
      popToast: 'toast/popToast',
    }),
  },
};
</script>
