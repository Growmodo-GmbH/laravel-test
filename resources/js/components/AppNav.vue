<template>
  <Popover class="relative bg-white dark:bg-slate-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
      <div
        class="flex items-center justify-between border-b-2 border-gray-100 py-6 dark:border-slate-700 md:justify-start md:space-x-10"
      >
        <div class="-my-2 -mr-2 md:hidden">
          <PopoverButton
            class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 dark:bg-slate-800 dark:hover:bg-slate-800"
            @click="openDrop"
          >
            <span class="sr-only">Open menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <div
          v-if="authenticated && user"
          class="hidden items-center justify-end md:flex md:flex-1 lg:w-0"
        >
          <div ref="dropMenu" class="relative">
            <div
              class="cursor-pointer items-center p-3 text-base font-medium tracking-wider text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-400"
              @click="drop = !drop"
            >
              {{ user && user.name ? user.name : '' }}
              <UserCircleIcon class="float-right ml-2 mt-0 h-6 w-6" />
            </div>

            <div
              v-show="drop"
              class="absolute right-5 z-10 flex w-auto flex-col whitespace-nowrap rounded border bg-white shadow-md dark:bg-slate-900"
              @click="drop = !drop"
            >
              <router-link
                v-if="authenticated"
                v-slot="{ isActive }"
                :to="{ name: 'dashboard' }"
              >
                <span
                  class="flex items-center p-4 pl-8 pr-10 hover:bg-slate-800 hover:text-white"
                  :class="[
                    isActive &&
                      'text-gray-800 hover:text-gray-900 dark:text-gray-600',
                  ]"
                >
                  <HomeIcon class="mr-2 h-6 w-6" />
                  Dashboard
                </span>
              </router-link>

              <router-link
                v-if="authenticated && roles && roles.admin"
                v-slot="{ isActive }"
                :to="{ name: 'users' }"
              >
                <span
                  class="flex items-center p-4 pl-8 pr-10 hover:bg-slate-800 hover:text-white"
                  :class="[
                    isActive &&
                      'text-gray-800 hover:text-gray-900 dark:text-gray-600',
                  ]"
                >
                  <UserCircleIcon class="mr-2 h-6 w-6" />
                  Users
                </span>
              </router-link>

              <div
                class="flex cursor-pointer items-center rounded-b p-4 pl-8 pr-10 text-gray-700 hover:bg-slate-800 hover:text-white"
                @click.prevent="logout(), closeDrop()"
              >
                <ArrowLeftOnRectangleIcon
                  class="mr-2 h-6 w-6"
                ></ArrowLeftOnRectangleIcon>
                Logout
              </div>
            </div>
          </div>
        </div>

        <div
          v-if="!authenticated"
          class="hidden items-center justify-end md:flex md:flex-1 lg:w-0"
        >
          <router-link
            v-slot="{ isActive }"
            :to="{ name: 'login' }"
            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-400"
            @click="closeDrop"
          >
            <span
              :class="[
                isActive &&
                  'cursor-default text-gray-800 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-500',
              ]"
            >
              Sign in
            </span>
          </router-link>

          <router-link
            v-slot="{ isActive }"
            :to="{ name: 'register' }"
            @click="closeDrop"
          >
            <AppButton
              primary
              text="Sign Up"
              class="ml-8"
              :class="[isActive && 'opacity-60']"
            />
          </router-link>
        </div>
      </div>
    </div>
    <transition
      enter-active-class="duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="duration-100 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <PopoverPanel
        v-show="drop"
        v-slot="{ close }"
        focus
        class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden"
      >
        <div
          class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 dark:divide-gray-700 dark:bg-slate-900"
        >
          <div class="px-5 pt-5">
            <div class="flex items-center justify-between">
              <div class="-mr-2">
                <PopoverButton
                  class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 dark:bg-slate-800"
                >
                  <span class="sr-only">Close menu</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
          </div>
          <div class="px-5 py-6">
            <div class="">
              <div v-if="authenticated" class="mb-6 text-left">
                <router-link
                  v-slot="{ isActive }"
                  :to="{ name: 'dashboard' }"
                  class="text-base font-medium text-gray-500 hover:text-gray-900 dark:hover:text-gray-200"
                  @click="close"
                >
                  <span
                    :class="[
                      isActive &&
                        'text-gray-800 hover:text-gray-900 dark:text-gray-600',
                    ]"
                  >
                    <HomeIcon class="float-left mr-2 h-6 w-6" /> Dashboard
                  </span>
                </router-link>
              </div>
              <div
                v-if="authenticated && roles && roles.admin"
                class="mb-6 text-left"
              >
                <router-link
                  v-slot="{ isActive }"
                  :to="{ name: 'users' }"
                  class="text-base font-medium text-gray-500 hover:text-gray-900 dark:hover:text-gray-200"
                  @click="close"
                >
                  <span
                    :class="[
                      isActive &&
                        'text-gray-800 hover:text-gray-900 dark:text-gray-600',
                    ]"
                  >
                    <UserCircleIcon class="float-left mr-2 h-6 w-6" /> Users
                  </span>
                </router-link>
              </div>
            </div>
            <div v-if="!authenticated">
              <router-link v-slot="{ isActive }" :to="{ name: 'register' }">
                <AppButton
                  primary
                  text="Sign up"
                  class="flex w-full items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-primary-700"
                  :class="[isActive && 'opacity-60']"
                  @click="close"
                />
              </router-link>
              <p class="mt-6 text-center text-base font-medium text-gray-500">
                or
                <router-link
                  v-slot="{ isActive }"
                  :to="{ name: 'login' }"
                  class="whitespace-nowrap text-base font-medium text-primary-500 hover:text-primary-900 dark:text-primary-300 dark:hover:text-primary-400"
                  @click="close"
                >
                  <span
                    :class="[
                      isActive &&
                        'text-primary-800 hover:text-primary-900 dark:text-primary-500 dark:hover:text-primary-500',
                    ]"
                  >
                    Sign in
                  </span>
                </router-link>
              </p>
            </div>
            <div v-if="authenticated">
              <AppButton
                primary
                text="Logout"
                type="button"
                class="flex w-full items-center justify-center px-4 py-2"
                @click.prevent="logout(), closeDrop()"
              >
                <template #text>
                  <ArrowLeftOnRectangleIcon
                    class="mr-2 h-6 w-6"
                  ></ArrowLeftOnRectangleIcon>
                  Logout
                </template>
              </AppButton>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import { parseDisplayDate } from '@services/common';
import {
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
  Switch,
} from '@headlessui/vue';
import {
  Bars3Icon,
  HomeIcon,
  BuildingLibraryIcon,
  InformationCircleIcon,
  DocumentTextIcon,
  XMarkIcon,
  CogIcon,
  ArrowLeftOnRectangleIcon,
  ChevronDownIcon,
  UserCircleIcon,
} from '@heroicons/vue/24/outline';

export default {
  name: 'AppNav',
  components: {
    HomeIcon,
    BuildingLibraryIcon,
    InformationCircleIcon,
    DocumentTextIcon,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Bars3Icon,
    XMarkIcon,
    CogIcon,
    ArrowLeftOnRectangleIcon,
    ChevronDownIcon,
    UserCircleIcon,
    Switch, // eslint-disable-line
  },
  props: {},
  data() {
    return {
      drop: false,
      errors: null,
      success: '',
      loading: false,
    };
  },
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
      user: 'auth/user',
      roles: 'auth/roles',
      currentUserToken: 'auth/currentUserToken',
    }),
  },
  methods: {
    ...mapActions({
      logout: 'auth/logout',
      updateTheme: 'auth/theme',
      popToast: 'toast/popToast',
    }),
    parseDisplayDate,
    closeDrop() {
      this.drop = false;
    },
    openDrop() {
      this.drop = true;
    },
  },
};
</script>

<style scoped></style>
<style lang="scss" scoped></style>
