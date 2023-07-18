<template>
  <tr class="bg-gray-100 text-gray-900 dark:bg-slate-700 dark:text-gray-100">
    <td class="border-b border-gray-300 px-5 py-5 text-sm dark:border-gray-500">
      <div class="flex items-center">
        <p class="whitespace-nowrap text-xs">
          {{ user.name }}
        </p>
      </div>
    </td>
    <td class="border-b border-gray-300 px-5 py-5 text-xs dark:border-gray-500">
      <div class="flex items-center">
        <a
          class="whitespace-nowrap"
          :href="'mailto:' + user.email"
          title="send email"
        >
          {{ user.email }}
        </a>
      </div>
    </td>
    <td class="border-b border-gray-300 px-5 py-5 text-xs dark:border-gray-500">
      <div class="flex items-center">
        <p class="whitespace-nowrap text-xs">
          {{ user.phone_number }}
        </p>
      </div>
    </td>
    <td class="border-b border-gray-300 px-5 py-5 text-xs dark:border-gray-500">
      <p v-if="user.created_at" class="whitespace-nowrap">
        {{ parseDisplayDate(user.created_at) }}
      </p>
    </td>
    <td class="border-b border-gray-300 px-5 py-5 text-xs dark:border-gray-500">
      <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
        <div class="whitespace-nowrap">
          <div
            class="inline rounded px-1 py-0"
            :class="
              user.subscribed
                ? 'bg-green-700 text-gray-100'
                : 'bg-red-700 text-gray-100'
            "
          >
            {{ user.subscribed ? 'Subscribed' : 'Unsubscribed' }}
          </div>
        </div>
      </span>
    </td>
    <td
      class="whitespace-nowrap border-b border-gray-300 px-5 py-5 text-sm dark:border-gray-500"
    >
      <AppButton
        v-tippy="'Edit User'"
        warning
        :loading="!dataReady"
        class="mr-2 px-1 py-1 text-sm"
        @click="triggerEditUser"
      >
        <template #text>
          <PencilSquareIcon v-if="dataReady" class="ml-2 mr-2 mt-0 h-4 w-4" />
          <CircleSvg v-if="!dataReady" class="mr-2 h-3 w-3" />
          <span class="sr-only">Edit User</span>
        </template>
      </AppButton>

      <AppButton
        v-tippy="'Delete User'"
        danger
        :loading="!dataReady"
        class="mr-2 px-1 py-1 text-sm"
        @click="triggerDeleteUser"
      >
        <template #text>
          <TrashIcon v-if="dataReady" class="ml-2 mr-2 mt-0 h-4 w-4" />
          <CircleSvg v-if="!dataReady" class="mr-2 h-3 w-3" />
          <span class="sr-only">Delete User</span>
        </template>
      </AppButton>
    </td>
  </tr>
</template>

<script lang="ts">
import moment from 'moment';
import {
  PencilSquareIcon,
  TrashIcon,
  UserCircleIcon,
} from '@heroicons/vue/24/outline';
import CircleSvg from '@components/CircleSvg.vue';
import { mapActions } from 'vuex';

export default {
  name: 'UsersTableRow',
  components: {
    CircleSvg,
    PencilSquareIcon,
    TrashIcon,
    UserCircleIcon,
  },
  props: {
    user: { type: Object, required: true },
    dataReady: { type: Boolean, default: false },
    availableRoles: { type: Array, default: null },
  },
  setup() {
    return {};
  },
  data() {
    return {};
  },
  computed: {},
  watch: {},
  created() {},
  mounted() {},
  beforeUnmount() {},
  updated() {},
  methods: {
    ...mapActions({
      popToast: 'toast/popToast',
    }),
    roleClass(slug) {
      if (slug == 'admin') {
        return 'bg-orange-100 text-orange-800 dark:bg-orange-700 dark:text-gray-100';
      }
      if (slug == 'user') {
        return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-gray-100';
      }
      return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100';
    },
    parseDisplayDate(date) {
      return moment(date).format('MMM Do YYYY, h:mma');
    },
    triggerEditUser() {
      this.$emit('editUser', this.user);
    },
    triggerDeleteUser() {
      const self = this;
      const title = `<strong>Delete ${this.user.name}?</strong>`;
      const html = 'Are you sure you want to <strong>Delete';
      `${this.user.name}</strong>?<small> (${this.user.email})</small><h6>This will delete the user.</h6>`;
      const icon = 'warning';
      const confirmButtonColor = '#FF0000';
      const denyButtonColor = '#777777';
      const confirmButtonText = 'Delete';
      const denyButtonText = 'Cancel';
      self.$swal
        .fire({
          title,
          icon,
          html,
          showCancelButton: false,
          showDenyButton: true,
          confirmButtonColor,
          denyButtonColor,
          confirmButtonText,
          denyButtonText,
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$emit('deleteUser', this.user);
          } else if (result.isDenied) {
            self.popToast({
              message: 'Cancelled',
              timer: 2000,
              icon: 'error',
            });
          }
        });
    },
  },
};
</script>
