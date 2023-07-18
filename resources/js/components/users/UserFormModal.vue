<template>
  <AppModal :show-modal="showingForm" @close-modal="closeModal">
    <template #title>
      {{ 'Editing User ' + userName }}
    </template>
    <template #body>
      <Errors
        v-if="errors && useInlineMessage"
        :content="errors"
        :errors="errors"
        container-class="w-100 mb-5"
        type="error"
        @close="errors = null"
      />
      <form @submit.prevent>
        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 flex-auto">
            <input
              id="name"
              v-model="form.name"
              type="text"
              placeholder="Name"
              name="name"
              class="relative w-full rounded border bg-white bg-white px-3 py-3 pr-10 text-sm shadow outline-none focus:outline-none"
              :class="
                errors && errors.name
                  ? 'border-red-500 text-red-600 placeholder-red-500 dark:placeholder-red-600'
                  : 'border-transparent text-slate-600 placeholder-slate-300 dark:placeholder-slate-400'
              "
            />
            <span
              class="absolute absolute right-0 z-10 h-full w-8 items-center justify-center rounded bg-transparent py-3 pr-3 text-center text-base font-normal leading-snug text-slate-300"
            >
              <span
                class="fas fa-user"
                :class="
                  errors && errors.name ? 'text-red-600' : 'text-slate-300'
                "
              />
            </span>
          </div>
        </div>

        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 flex-auto">
            <input
              id="email"
              v-model="form.email"
              type="text"
              placeholder="E-mail"
              name="email"
              class="relative w-full rounded border bg-white bg-white px-3 py-3 pr-10 text-sm shadow outline-none focus:outline-none"
              :class="
                errors && errors.email
                  ? 'border-red-500 text-red-600 placeholder-red-500 dark:text-red-600 dark:placeholder-red-600'
                  : 'border-transparent text-slate-600 placeholder-slate-300 dark:placeholder-slate-400'
              "
            />
            <span
              class="absolute absolute right-0 z-10 h-full w-8 items-center justify-center rounded bg-transparent py-3 pr-3 text-center text-base font-normal leading-snug"
            >
              <span
                class="fas fa-envelope"
                :class="
                  errors && errors.email ? 'text-red-600' : 'text-slate-300'
                "
              />
            </span>
          </div>
        </div>

        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 flex-auto">
            <input
              id="phone_number"
              v-model="form.phone_number"
              type="text"
              placeholder="Phone Number"
              name="phone_number"
              class="relative w-full rounded border bg-white bg-white px-3 py-3 pr-10 text-sm shadow outline-none focus:outline-none"
              :class="
                errors && errors.phone_number
                  ? 'border-red-500 text-red-600 placeholder-red-500 dark:text-red-600 dark:placeholder-red-600'
                  : 'border-transparent text-slate-600 placeholder-slate-300 dark:placeholder-slate-400'
              "
            />
            <span
              class="absolute absolute right-0 z-10 h-full w-8 items-center justify-center rounded bg-transparent py-3 pr-3 text-center text-base font-normal leading-snug"
            >
              <span
                class="fas fa-phone"
                :class="
                  errors && errors.phone_number
                    ? 'text-red-600'
                    : 'text-slate-300'
                "
              />
            </span>
          </div>
        </div>

        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 flex-auto">
            <input
              id="password"
              v-model="form.password"
              type="password"
              placeholder="Password"
              name="password"
              autocomplete="on"
              class="relative w-full rounded border bg-white bg-white px-3 py-3 pr-10 text-sm shadow outline-none focus:outline-none"
              :class="
                errors && errors.password
                  ? 'border-red-500 text-red-600 placeholder-red-500 dark:text-red-600 dark:placeholder-red-600'
                  : 'border-transparent text-slate-600 placeholder-slate-300 dark:placeholder-slate-400'
              "
            />
            <span
              class="absolute absolute right-0 z-10 h-full w-8 items-center justify-center rounded bg-transparent py-3 pr-3 text-center text-base font-normal leading-snug"
            >
              <span
                class="fas fa-user-shield"
                :class="
                  errors && errors.email ? 'text-red-600' : 'text-slate-300'
                "
              />
            </span>
          </div>
        </div>
        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 flex-auto">
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              placeholder="Password Confirmation"
              name="password_confirmation"
              autocomplete="on"
              class="relative w-full rounded border bg-white bg-white px-3 py-3 pr-10 text-sm shadow outline-none focus:outline-none"
              :class="
                errors && errors.password
                  ? 'border-red-500 text-red-600 placeholder-red-500 dark:placeholder-red-600'
                  : 'border-transparent text-slate-600 placeholder-slate-300 dark:placeholder-slate-400'
              "
            />
            <span
              class="absolute absolute right-0 z-10 h-full w-8 items-center justify-center rounded bg-transparent py-3 pr-3 text-center text-base font-normal leading-snug"
            >
              <span
                class="fas fa-user-shield"
                :class="
                  errors && errors.email ? 'text-red-600' : 'text-slate-300'
                "
              />
            </span>
          </div>
        </div>

        <div class="relative mb-3 flex w-full flex-wrap items-stretch">
          <div class="flex-item relative mb-3 ml-3 flex-auto">
            <div class="my-1 mr-3 w-full py-2 sm:flex sm:items-center">
              <span
                :class="
                  loading || submitting
                    ? 'default disabled cursor-pointer'
                    : 'cursor-pointer'
                "
                @click="form.subscribed = !form.subscribed"
              >
                <span
                  class="fa-solid fa-fw fa-2x float-left mr-4 text-slate-600 dark:text-gray-300"
                  :class="form.subscribed ? 'fa-toggle-on' : 'fa-toggle-off'"
                />
                <span
                  v-if="loading"
                  class="fa-solid fa-fw fa-1x fa-circle-notch fa-spin absolute float-left mr-4 text-slate-600"
                  style="left: -1.4em; top: 1.2em"
                />
                <span class="mt-1 inline-block text-sm">
                  {{ form.subscribed ? 'Subscribed' : 'Unsubscribed' }}
                </span>
              </span>
            </div>
          </div>
        </div>
      </form>
    </template>
    <template #footer>
      <hr />
      <div style="width: 100%">
        <AppButton
          v-if="changed"
          :disabled="loading || submitting || !changed"
          class="float-left border border-green-800 bg-transparent bg-transparent text-sm font-medium text-green-800 shadow-md transition duration-150 ease-in-out hover:border-green-900 hover:bg-green-900 hover:text-white hover:shadow-lg focus:shadow-lg active:shadow-lg dark:hover:border-green-800 dark:hover:bg-green-800"
          @click="submit"
        >
          <template #text>
            {{ submitting ? 'Updating' : 'Update' }}
            <span v-if="submitting" class="fa fa-circle-notch fa-spin ml-3" />
          </template>
        </AppButton>
        <AppButton
          :disabled="loading || submitting"
          class="float-right border border-gray-700 bg-transparent bg-transparent text-sm font-medium text-gray-700 text-white shadow-md transition duration-150 ease-in-out hover:border-gray-700 hover:bg-gray-700 hover:text-white hover:shadow-lg focus:shadow-lg active:shadow-lg dark:hover:bg-gray-700"
          @click="closeModal"
        >
          <template #text>
            {{ changed ? 'Cancel' : 'Close' }}
          </template>
        </AppButton>
      </div>
    </template>
  </AppModal>
</template>

<script lang="ts">
import AppModal from '@components/common/AppModal.vue';
import axios from 'axios';
import { mapActions } from 'vuex';
import { UserCircleIcon } from '@heroicons/vue/24/outline';
import clonedeep from 'lodash.clonedeep';
import moment from 'moment';
import Errors from '@components/Errors.vue';

export default {
  name: 'UserFormModal',
  components: {
    AppModal,
    UserCircleIcon,
    Errors,
  },
  props: {
    showingForm: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    user: { type: Object, default: null },
    useInlineMessage: { type: Boolean, default: true },
  },
  setup() {
    return {};
  },
  data() {
    return {
      userName: '',
      form: {
        name: null,
        email: null,
        phone_number: null,
        password: null,
        password_confirmation: null,
        subscribed: 0,
      },
      submitting: false,
      errors: null,
      changed: false,
      ready: false,
    };
  },
  computed: {},
  watch: {
    form: {
      handler(newValue, oldValue) {
        if (this.ready) {
          this.changed = true;
        }
      },
      deep: true,
      immediate: false,
    },
  },
  created() {},
  mounted() {
    const self = this;
    if (self.user) {
      self.form = clonedeep(self.user);
      if (self.user.name) {
        self.userName = self.user.name;
      }
      setTimeout(() => {
        self.ready = true;
      }, 100);
    } else {
      self.ready = true;
    }
  },
  beforeUnmount() {},
  updated() {},
  methods: {
    ...mapActions({
      popToast: 'toast/popToast',
    }),
    parseDisplayDate(date) {
      if (date && date != true) {
        return moment(date).format('MMM Do YYYY, h:mma');
      }
      return moment(new Date()).format('MMM Do YYYY, h:mma');
    },
    async submit() {
      this.error = null;
      this.submitting = true;
      await this.updateUser();
      this.submitting = false;
    },
    async updateUser() {
      await axios
        .patch(`/api/users/update-user/${this.user.id}`, this.form)
        .then(({ data }) => {
          this.$emit('userUpdated', data.user);
          this.popToast({
            message: `User ${data.user.name} Successfully Updated!`,
            timer: 5000,
            icon: 'success',
          });
          this.submitting = false;
        })
        .catch(({ response }) => {
          if (response.status === 422) {
            const { errors } = response.data;
            this.errors = errors;
          } else {
            this.popToast({
              message: 'Error Updating User',
              timer: 5000,
              icon: 'error',
            });
          }
          this.submitting = false;
        });
      this.submitting = false;
    },
    toggleUserSubscribe() {
      if (this.form.subscribed) {
        this.form.subscribed = 0;
      } else {
        this.form.subscribed = 1;
      }
    },
    closeModal() {
      this.$emit('closeModal');
    },
  },
};
</script>
