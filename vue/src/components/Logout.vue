<template>
    <button class="mx-3 text-red-800 font-bold py-2 px-4 rounded-md" @click="logout">
        Logout
    </button>
</template>

<script>
    import { useRouter } from 'vue-router';
    import store from '../store';

    const router = useRouter();

    export default {
        name: 'Home',
        data(){
            return {
                user: {},
                deletedUser: null,
            };
        },
        methods: {
            logout(){
                store.dispatch('logout')
                    .then((res) => {
                        console.log(res)
                        sessionStorage.clear();
                        location.href = '/';
                    })
            }
        }
    }
</script>

<style>

</style>