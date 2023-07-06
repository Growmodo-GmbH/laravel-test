<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">

            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <!-- error message -->
                    <span v-if="errors">
                      <span v-for="(type, index) in errors" :key="index">
                      <p class="text-red-600 italic" v-for="(error, ndx) in type" :key="ndx">{{ error }}</p>
                      </span>
                    </span>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900 text-center" id="modal-title">Delete account</h3>
                        <div class="my-4">
                          <p class="text-sm text-gray-500 text-center">Are you sure you want to delete <b>{{ deletedUser.username }}</b>? All of <b>{{ deletedUser.username }}'s</b> data will be permanently removed. This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 justify-center sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto" @click="deleteUser(deletedUser.id)">Submit</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="close">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>      
</template>

<script>
import axiosClient from '../axios';
import store from '../store';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                deletedUser: { ...this.user }
            };
        },
        methods: {
            close(){
                this.$emit('close');
            },
            deleteUser(id){
              axiosClient.delete(`/delete/${id}`)
                        .then((response) => {
                            this.success = response.data.message;
                            this.$emit('success', this.success);
                            
                          
                            if(store.state.user.data['user_type'] === 'User' || store.state.user.data['id'] == this.deletedUser.id){
                              this.$emit('ifUser');
                            }
                            this.close();
                        })
                        .catch((error) => {
                            console.log(error);
                            this.errors = error.response.data.errors;
                        });
            }
        },
    };
</script>