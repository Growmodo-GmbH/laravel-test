<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form class="px-8 pt-6 pb-8 mb-4" @submit.prevent="editUser">
                    <div class="flex items-center justify-end w-full mb-2">
                        <svg @click="close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-800 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>                          
                    </div>

                    <div class="flex items-center justify-center w-full mb-2">
                        <h1 class="text-2xl font-bold text-blue-800">Edit a User</h1>
                    </div>

                    <span v-if="errors">
                        <span v-for="(type, index) in errors" :key="index">
                            <span v-for="(error, index) in type" :key="index">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 my-2 rounded relative" role="alert">
                                <span class="block sm:inline">{{ error }}</span>
                            </div>
                            </span>
                        </span>
                    </span>
            
                    <div class="mb-4">
                      <label class="block text-blue-800 text-sm font-bold mb-2" for="username">
                        Username
                      </label>
                      <input v-model="editedUser.username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                    </div>
                    <div class="mb-4">
                        <label class="block text-blue-800 text-sm font-bold mb-2" for="email">
                          Email Address
                        </label>
                        <input v-model="editedUser.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email Address">
                    </div>
                    <div class="mb-6">
                        <label class="block text-blue-800 text-sm font-bold mb-2" for="phone_number">
                          Phone Number
                        </label>
                        <input v-model="editedUser.phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" type="tel" placeholder="0912-345-6789">
                    </div>
                    <div class="flex items-center justify-center w-full">
                      <button class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
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
            editedUser: { ...this.user },
            errors: null,
            success: ''
        };
    },
    methods: {
        close(){
            this.$emit('close');
        },
        editUser(){
            this.$axios.get('/sanctum/csrf-cookie')
            .then(response => {
            this.$axios.put(`api/edit/${this.editedUser.id}`, this.editedUser)
                .then(response => {
                if (response.data.success) {
                    this.success = response.data.message;
                    this.$emit('success', this.success);                        
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
    }
};
</script>

<style>

</style>