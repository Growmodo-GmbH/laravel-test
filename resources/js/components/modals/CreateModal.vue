<template>
  <dialog class="modal" :open="showCreateModal">
    <form method="dialog" class="modal-box" @submit.prevent="createUser()">
      <h3 class="font-bold text-lg text-center uppercase">Create a new User</h3>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input name="username" type="text" placeholder="Username" v-model="user.username" class="input input-bordered" />
        <p v-if="errors['username']" class="text-red-500 text-xs font-semibold">{{ errors['username'][0] }}</p>
        <label class="label">
          <span class="label-text">Email Address</span>
        </label>
        <input name="email" type="email" placeholder="Email Address" v-model="user.email" class="input input-bordered" />
        <p v-if="errors['email']" class="text-red-500 text-xs font-semibold">{{ errors['email'][0] }}</p>
        <label class="label">
          <span class="label-text">Phone Number</span>
        </label>
        <input name="phone_number" type="text" placeholder="Phone Number" v-model="user.phone_number" class="input input-bordered" />
        <p v-if="errors['phone_number']" class="text-red-500 text-xs font-semibold">{{ errors['phone_number'][0] }}</p>
      </div>
      <div>
        <button class="btn btn-success btn-sm mt-5">Create</button>
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
  props: {
    user: {
      type: Object,
      required: true,
    },
    showCreateModal: {
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
    createUser() {
      store.dispatch('createUser', this.user)
        .then(response => {
          this.$emit('updateShowCreateModal', response.showModal);
          this.$notify({
            type: 'success',
            title: "User Created",
            text: `<b>${response.user.username}</b> has been successfully created.`,
          });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
  },
}
</script>