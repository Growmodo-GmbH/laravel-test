<template>
  <dialog class="modal" :open="showUpdateModal">
    <form method="dialog" class="modal-box" @submit.prevent="editUser()">
      <h3 class="font-bold text-lg text-center uppercase">Update {{ user.username }}'s details</h3>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input name="username" type="text" placeholder="Username" v-model="user.username" class="input input-bordered" />
        <p v-if="errors['username']" class="text-red-500 text-xs font-semibold">{{ errors['username'][0] }}</p>
        <label class="label">
          <span class="label-text">Email Address</span>
        </label>
        <input name="email" type="text" placeholder="Email Address" v-model="user.email" class="input input-bordered" />
        <p v-if="errors['email']" class="text-red-500 text-xs font-semibold">{{ errors['email'][0] }}</p>
        <label class="label">
          <span class="label-text">Phone Number</span>
        </label>
        <input name="phone_number" type="text" placeholder="Phone Number" v-model="user.phone_number" class="input input-bordered" />
        <p v-if="errors['phone_number']" class="text-red-500 text-xs font-semibold">{{ errors['phone_number'][0] }}</p>
      </div>
      <div>
        <button class="btn btn-info btn-outline btn-sm mt-5">Edit</button>
      </div>
    </form>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
</template>

<script>
import store from '../../store';

export default {
  data() {
    return {
      errors: [],
    }
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
    selectedUser: {
      type: Object,
      required: true,
    },
    showUpdateModal: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      errors: [],
    }
  },
  methods: {
    editUser() {
      store.dispatch('editUser', {
        user: this.user, 
        index: this.selectedUser.index
      })
        .then(response => {
          this.$emit('updateShowUpdateModal', response.showModal);
          this.$notify({
            title: "User Updated",
            text: `<b>${response.user.username}</b> has been successfully updated.`,
          })
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
  }
}
</script>