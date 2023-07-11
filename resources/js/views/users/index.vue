<template>
  <div>
    <h1 class="text-5xl font-bold text-center mt-10 mb-5">Users Record</h1>
    
    <div class="flex flex-col items-center justify-center">
      <button 
        class="btn btn-success btn-xs btn-outline mr-2 mb-5"
        @click="openCreateModal()"
      >
        Create a new User
      </button>
    </div>
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user, index in getUsers" :key="user.id">
            <th>{{ user.id }}</th>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone_number }}</td>
            <td>
              <button 
                class="btn btn-info btn-xs btn-outline mr-2"
                @click="showEditModal(user, index)"
              >
                Edit
              </button>
              <button 
                class="btn btn-error btn-xs btn-outline"
                @click="showDeleteConfirmation(user)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <notifications position="top right" />

    <div class="flex flex-col items-center mt-10 justify-center">
      <router-link :to="{ name: 'Welcome' }">
        <button class="btn btn-neutral btn-sm mr-2 mb-5">Home</button>
      </router-link>
    </div>

    <CreateModal :user="user" :showCreateModal="showCreateModal" @updateShowCreateModal="updateCreateModal($event)" />
    <UpdateModal :user="user" :selectedUser="selectedUser" :showUpdateModal="showUpdateModal" @updateShowUpdateModal="updateUpdateModal($event)" />
    <DeleteModal :selectedUser="selectedUser" :showDeleteModal="showDeleteModal" />
  </div>
</template>

<script>
import store from '../../store'

import CreateModal from '../../components/modals/CreateModal.vue'
import UpdateModal from '../../components/modals/UpdateModal.vue'
import DeleteModal from '../../components/modals/DeleteModal.vue'

export default {
  name: 'UserIndex',
  components: {
    DeleteModal,
    CreateModal,
    UpdateModal,
  },
  data() {
    return {
      users: [],
      user: {
        id: null,
        username: '',
        email: '',
        phone_number: '',
      },
      selectedUser: {
        id: null,
        name: '',
        index: null,
      },
      showCreateModal: false,
      showUpdateModal: false,
      showDeleteModal: false,
      errors: [],
    }
  },
  created() {
    store.dispatch('users');
  },
  methods: {
    updateCreateModal(data) {
      this.showCreateModal = data;
    },
    updateUpdateModal(data) {
      this.showUpdateModal = data;
    },
    showEditModal(user, index) {
      this.showUpdateModal = !this.showUpdateModal

      this.selectedUser.index = index;
      this.user.id = user.id;
      this.user.username = user.username;
      this.user.email = user.email;
      this.user.phone_number = user.phone_number;
    },
    showDeleteConfirmation(user) {
      this.showDeleteModal = !this.showDeleteModal;
      this.selectedUser.id = user.id;
      this.selectedUser.username = user.username;
    },
    openCreateModal() {
      this.showCreateModal = !this.showCreateModal;
      this.clearUserData();
    },
    clearUserData() {
      this.selectedUser.index = null;
      this.user.id = null;
      this.user.username = '';
      this.user.email = '';
      this.user.phone_number = '';
    }
  },
  computed: {
    getUsers() {
      return store.getters.getUsers;
    },
    getUser() {
      return store.getters.getUser;
    }
  }
}
</script>
