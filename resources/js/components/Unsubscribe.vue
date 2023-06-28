<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form class="px-8 pt-6 pb-8 mb-4">
                    <div class="flex items-center justify-end w-full mb-2">
                        <svg @click="close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-800 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>                          
                    </div>

                    <div class="flex items-center justify-center w-full mb-2">
                        <h1 class="text-2xl font-bold text-blue-800">Delete Your Account</h1>
                    </div>
                    <div class="my-4">
                      <p class="text-md text-blue-800 text-center">Are you sure you want to delete <b>your account</b>? All of <b>your</b> data will be permanently removed. This action cannot be undone.</p>
                    </div>
                    <div class="flex items-center justify-center w-full">
                      <button @click="close" class="mx-2 bg-transparent hover:bg-red-800 text-red-900 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                        Cancel
                      </button>
                      <button @click="unsubscribe" class="mx-2 bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Confirm
                      </button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>      
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            id: null,
        };
    },
    methods: {
        close(){
            this.$emit('close');
        },
        unsubscribe(){
            this.id = window.Laravel.user.id;
            this.$axios.get('/sanctum/csrf-cookie')
              .then(response => {
              this.$axios.delete(`api/delete/${this.id}`)
                  .then(response => {
                  if (response.data.success) {
                      this.success = response.data.message;
                      window.location.href = "/";                      
                      this.close();
                  } else {
                      this.errors = response.data.message;
                  }
                  })
                  .catch(error => {
                  console.log(error);
                  });
              });
        }
    },
};
</script>

<style>

</style>