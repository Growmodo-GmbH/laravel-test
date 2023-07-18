<template>
  <div class="mx-auto max-w-screen-lg text-gray-900">
    <div class="flex justify-center">
      <div class="flex-1">
        <div class="w-auto rounded border dark:border-gray-600">
          <div
            class="border-b p-4 font-semibold dark:border-gray-600 dark:text-gray-200"
          >
            Users
          </div>
          <div
            class="rounded bg-white p-4 dark:bg-slate-800 dark:text-gray-300"
          >
            <UsersTable
              :users="users"
              :pagination="pagination"
              :per-page="perPage"
              :data-ready="dataReady"
              :available-roles="availableRoles"
              @get-users="getUsers"
              @delete-user="deleteUser"
              @edit-user="editUser"
            />
          </div>
        </div>
      </div>
    </div>
  </div>

  <UserFormModal
    :key="userFormKey"
    :showing-form="showCreateUserForm"
    :user="userEditing"
    @close-modal="closeUserForm"
    @user-updated="userUpdated"
  />
</template>

<script lang="ts">
import CircleSvg from '@components/CircleSvg.vue';
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';
import UsersTable from '@components/admin/UsersTable.vue';
import UserFormModal from '@components/users/UserFormModal.vue';

export default {
  name: 'Users',
  components: {
    UsersTable,
    UserFormModal,
    CircleSvg,
  },
  props: {},
  setup() {
    return {};
  },
  data() {
    return {
      users: [],
      pagination: {
        current_page: 1,
      },
      perPage: 10,
      dataReady: false,
      showCreateUserForm: false,
      userEditing: null,
      creatingNewUser: false,
      userFormKey: 432489,
      availableRoles: [],
      rolesDataReady: false,
    };
  },
  computed: {
    ...mapGetters({
      authenticated: 'auth/authenticated',
      user: 'auth/user',
      roles: 'auth/roles',
    }),
  },
  watch: {},
  created() {},
  mounted() {
    this.getUsers();
  },
  beforeUnmount() {},
  updated() {},
  methods: {
    ...mapActions({
      popToast: 'toast/popToast',
      verifyResend: 'auth/verifyResend',
    }),
    async getUsers(updatedPage = null) {
      if (updatedPage) {
        this.pagination.current_page = updatedPage;
      }
      await axios
        .get(
          `/api/users?page=${this.pagination.current_page}&per=${this.perPage}`,
        )
        .then(({ data }) => {
          this.users = data.data;
          delete data.data;
          this.pagination = data;
          this.dataReady = true;
        })
        .catch(({ response }) => {
          this.popToast({
            message: 'Error Getting Users',
            timer: 5000,
            icon: 'error',
          });
          this.dataReady = true;
        });
      this.dataReady = true;
    },
    async deleteUser(value) {
      await axios
        .delete(`/api/users/delete/user/${value.id}`)
        .then(({ data }) => {
          this.users = this.users.filter((u) => u.id != data.id);
          this.popToast({
            message: 'Successfully Deleted!',
            timer: 5000,
            icon: 'success',
          });
        })
        .catch(({ response }) => {
          this.popToast({
            message: 'Error Deleting User',
            timer: 5000,
            icon: 'error',
          });
          this.dataReady = true;
        });
    },
    triggerUpdateUser(user) {
      this.creatingNewUser = false;
      this.userEditing = user;
    },
    userUpdated(data) {
      this.users = this.users.map((u) => (u.id !== data.id ? u : data));
      this.getUsers(); // Realign just in case.
      this.closeUserForm();
    },
    closeUserForm() {
      this.userEditing = null;
      this.creatingNewUser = false;
      this.showCreateUserForm = false;
    },
    editUser(user) {
      this.userFormKey += 1;
      this.userEditing = user;
      this.creatingNewUser = false;
      this.showCreateUserForm = true;
    },
  },
};
</script>

<style scoped>
input:focus,
select:focus,
textarea:focus,
button:focus,
option:focus {
  outline: none !important;
  border: none !important;
}
</style>
<style lang="scss" scoped></style>
