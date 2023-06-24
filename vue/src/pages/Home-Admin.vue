<template>
    <div class="h-screen px-6 py-12 lg:px-8">
        <div class="flex flex-col md:flex-row md:mx-10 w-full md:w-auto">
            <div class="w-full md:w-1/2 my-5">
                <h1 class="text-3xl font-bold text-indigo-800 text-center md:text-start">
                    Welcome, {{ user.username }}
                </h1>
            </div>
            <div class="w-full md:w-1/2 flex justify-end my-5">
                <div class="flex w-full md:w-auto justify-center">
                    <button class="bg-indigo-600 mx-3 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md" @click="toggleRecords">
                      {{ isShow ? 'Hide' : 'View' }} Records
                    </button>
                    <Logout ref="logout" />
                </div>
            </div>
        </div>

        <!-- success message -->
        <div class="md:mx-10">
            <p class="text-indigo-600 my-4 italic" v-if="success">{{ success }}</p>
        </div>

        <div class="md:mx-10 box-border overflow-x-auto" v-if="isShow">
            <table class="table-auto w-full">
                <thead>
                  <tr>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">ID</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Username</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Email</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Phone Number</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Type</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Created At</th>
                    <th class="border bg-indigo-200 text-indigo-800 px-4 py-2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(u, index) in records" :key="index">
                    <td class="border px-4 py-2">{{ u.id }}</td>
                    <td class="border px-4 py-2">{{ u.username }}</td>
                    <td class="border px-4 py-2">{{ u.email }}</td>
                    <td class="border px-4 py-2">{{ u.phone_number }}</td>
                    <td class="border px-4 py-2">{{ u.user_type }}</td>
                    <td class="border px-4 py-2">{{ u.formatted_created_at }}</td>
                    <td class="border px-4 py-2">
                        <button class="w-1/2" @click="editUser(u)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-6 text-indigo-600 hover:text-indigo-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="w-1/2" @click="deleteUser(u)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-6 text-indigo-600 hover:text-indigo-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>

        <Edit v-if="editedUser" :user="editedUser" @success="showSuccessMg" @close="close"/>
        <Delete v-if="deletedUser" :user="deletedUser" @ifUser="logout" @success="showSuccessMg" @close="close"/>
    </div>
</template>
    
<script>
    import Edit from '../components/Edit.vue';
    import Delete from '../components/Delete.vue';
    import Logout from '../components/Logout.vue';
    import store from '../store';
    import axiosClient from '../axios';

    export default {
        components: {
            Edit,
            Delete,
            Logout
        },
        name: 'Home',
        data(){
            return {
                isShow: false,
                user: {},
                records: [],
                editedUser: null,
                deletedUser: null,
                success: ''
            };
        },
        methods: {
            toggleRecords(){
                this.isShow = !this.isShow;
            },
            editUser(user){
                this.editedUser = user
            },
            deleteUser(user){
                this.deletedUser = user
            },
            close(){
                this.editedUser = null;
                this.deletedUser = null;
            },
            showRecords(){
                axiosClient.get('/user')
                        .then(({data}) => {
                            this.records = data.users;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
            },
            showSuccessMg(response){
                this.success = response;
                this.showRecords();
            },
            logout(){
                this.$refs.logout.logout();
            }
        },
        mounted(){
            this.user = store.state.user.data;
            this.showRecords();
        }
    }
</script>