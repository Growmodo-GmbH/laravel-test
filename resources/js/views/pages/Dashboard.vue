<template>
  <div class="mx-auto max-w-screen-lg text-gray-900">
    <div class="flex justify-center">
      <div class="flex-1">
        <div class="w-auto rounded border dark:border-gray-600">
          <div
            class="border-b p-4 font-semibold dark:border-gray-600 dark:text-gray-200"
          >
            Dashboard
          </div>
          <div
            class="rounded bg-white p-4 dark:bg-slate-800 dark:text-gray-300"
          >
            <h1 class="mb-4 mt-4 text-center text-2xl">
              Welcome, {{ user?.name }}
            </h1>
          </div>

          <div class="mb-4 flex justify-center">
            <router-link v-if="roles.admin" :to="{ name: 'users' }">
              <AppButton primary text="View Records" />
            </router-link>

            <AppButton
              v-if="roles.user && user.subscribed"
              danger
              text="Unsubscribe"
              @click.prevent="toggleSubscribe('unsubscribe')"
            />
            <AppButton
              v-if="roles.user && !user.subscribed"
              primary
              text="Subscribe"
              @click.prevent="toggleSubscribe('subscribe')"
            />

            <AppButton
              warning
              text="Logout"
              class="ml-8"
              @click.prevent="logout()"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';

export default {
  name: 'Dashboard',
  components: {},
  data() {
    return {};
  },
  computed: {
    ...mapState('auth', {
      user: (state) => state.user,
    }),
    ...mapGetters({
      user: 'auth/user',
      roles: 'auth/roles',
    }),
  },
  methods: {
    ...mapActions({
      logout: 'auth/logout',
      toggleSubscribe: 'auth/toggleSubscribe',
    }),
  },
};
</script>
