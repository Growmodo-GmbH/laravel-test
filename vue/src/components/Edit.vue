<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">

            <div class="relative transform overflow-hidden rounded-lg w-full bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:items-start">
                    <!-- error message -->
                    <span v-if="errors">
                        <span v-for="(type, index) in errors" :key="index">
                        <p class="text-red-600 italic" v-for="(error, ndx) in type" :key="ndx">{{ error }}</p>
                        </span>
                    </span>
                    <form class="space-y-6 w-full" @submit.prevent="editUser">
                        <!-- username -->
                        <div>
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                            <div class="mt-2">
                            <input id="username" name="username" type="text" v-model="editedUser.username" autocomplete="username" placeholder="johndoe123" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <!-- email address -->
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <div class="mt-2">
                            <input id="email" name="email" type="email" v-model="editedUser.email" autocomplete="email" placeholder="johndoe@email.com" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
            
                        <!-- phone number -->
                        <div>
                            <label for="tel" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                            <div class="mt-2">
                            <input id="tel" name="phone_number" type="tel" v-model="editedUser.phone_number" autocomplete="tel" placeholder="0912-345-6789" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 justify-center sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto">Submit</button>
                            <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="close">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>      
</template>

<script>
import axiosClient from '../axios';

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
                errors: [],
                success: ''
            };
        },
        methods: {
            close(){
                this.$emit('close');
            },
            editUser(){
                axiosClient.put(`/edit/${this.editedUser.id}`, this.editedUser)
                        .then((response) => {
                            this.success = response.data.message;
                            this.$emit('success', this.success);
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