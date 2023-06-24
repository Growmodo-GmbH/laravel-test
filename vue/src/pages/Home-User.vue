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
                    <button class="bg-red-600 mx-3 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md" @click="deleteUser(user)">
                      Unsubscribe
                    </button>
                    <Logout ref="logout" />
                </div>
            </div>
        </div>
        <Delete v-if="deletedUser" :user="deletedUser" @ifUser="logout" @close="close"/>
    </div>
</template>
    
<script>
    import Edit from '../components/Edit.vue';
    import Delete from '../components/Delete.vue';
    import Logout from '../components/Logout.vue';
    import { useRouter } from 'vue-router';
    import axios from 'axios';
    import store from '../store';

    const router = useRouter();

    export default {
        components: {
            Edit,
            Delete,
            Logout
        },
        name: 'Home',
        data(){
            return {
                user: {},
                deletedUser: null,
            };
        },
        methods: {
            deleteUser(user){
                this.deletedUser = user
            },
            close(){
                this.deletedUser = null;
            },
            logout(){
                this.$refs.logout.logout();
            }
        },
        mounted(){
            this.user = store.state.user.data;
        }
    }
</script>