<template>
  <dialog class="modal" :open="showDeleteModal">
    <form method="dialog" class="modal-box">
      <h3 class="font-bold text-lg">Are you sure you want to delete <b class="text-indigo-500">{{ selectedUser.username }}</b>'s record?</h3>
      <div class="flex justify-center my-2">
        <button 
          @click="deleteUser()"
          class="btn btn-error btn-sm btn-outline mr-2"
        >
          Delete
        </button>
        <button 
          class="btn btn-neutral btn-sm btn-outline mr-2"
        >
          Cancel
        </button>
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
    selectedUser: {
      type: Object,
      required: true,
    },
    showDeleteModal: {
      type: Boolean,
      required: true,
    },
  },
  methods: {
    deleteUser() {
      store.dispatch('deleteUser', this.selectedUser.id)
        .then(() => {
          this.$notify({
            type: 'error',
            title: "User Deleted",
            text: `<b>${this.selectedUser.username}</b> has been successfully deleted.`,
          });
        })
    },
  },
}
</script>