<template>
  <div class="w-full mt-4">
    <button @click="toggleRecords" class="bg-transparent hover:bg-blue-800 text-blue-900 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
        {{ isShow ? 'Hide' : 'View' }} Records
    </button>

    <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 my-2 rounded relative" role="alert">
        <span class="block sm:inline">{{ success }}</span>
      </div>

    <div v-if="isShow" class="w-full overflow-x-auto">
        <table class="table-auto w-full mt-8">
            <thead>
            <tr>
                <th class="bg-blue-800 text-white px-4 py-2">ID</th>
                <th class="bg-blue-800 text-white px-4 py-2">Username</th>
                <th class="bg-blue-800 text-white px-4 py-2">Email Address</th>
                <th class="bg-blue-800 text-white px-4 py-2">Phone Number</th>
                <th class="bg-blue-800 text-white px-4 py-2">Type</th>
                <th class="bg-blue-800 text-white px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users" :key="index">
                <td class="border border-blue-800 text-blue-950 px-4 py-2">{{ user.id }}</td>
                <td class="border border-blue-800 text-blue-950 px-4 py-2">{{ user.username }}</td>
                <td class="border border-blue-800 text-blue-950 px-4 py-2">{{ user.email }}</td>
                <td class="border border-blue-800 text-blue-950 px-4 py-2">{{ user.phone_number }}</td>
                <td class="border border-blue-800 text-blue-950 px-4 py-2">{{ user.user_type }}</td>
                <td class="border border-blue-800 text-blue-950 px-4 py-2">
                    <div class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="edit(user)" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-1 mt-2 text-blue-800 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>       
                        <svg xmlns="http://www.w3.org/2000/svg" @click="deleted(user)" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-1 mt-2 text-blue-800 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>  
                    </div>                                   
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <Edit v-if="editedUser" :user="editedUser" @success="showSuccessMg" @close="close"/>
    <Delete v-if="deletedUser" :user="deletedUser" @success="showSuccessMg" @close="close"/>
  </div>
</template>

<script>
import Edit from './Edit.vue';
import Delete from './Delete.vue';

export default {
    components: {
        Edit,
        Delete
    },
    data(){
        return {
            users: [],
            editedUser: null,
            deletedUser: null,
            success: null,
            isShow: null
        };
    },
    mounted() {
        this.show();
    },
    methods: {
        show(){
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('api/show')
                .then(response => {
                    this.users = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        },
        edit(user){
            this.editedUser = user
        },
        deleted(user){
            this.deletedUser = user
        },
        close(){
            this.editedUser = null;
            this.deletedUser = null;
        },    
        showSuccessMg(response){
            this.success = response;
            this.show();
        },
        toggleRecords(){
            this.isShow = !this.isShow;
        }
    }
}
</script>

<style>

</style>