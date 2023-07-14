<template>
    <div class="wp-wrapper">
        <h1 class="mb-4">Welcome, {{ username }}</h1>
        <div v-if="isAdmin" class="text-center">
            <button class="btn btn-primary" @click="viewRecords">View Records</button>
            <button class="btn btn-primary" @click="logout">Logout</button>
        </div>
        <div v-else class="text-center">
            <button class="btn btn-primary" @click="unsubscribe">Unsubscribe</button>
            <button class="btn btn-primary" @click="logout">Logout</button>
        </div>
    </div>
</template>

<script>
import {api, toast} from '../../../utils';
import store from '../../store';

export default {
    store,
    computed: {
        // Get the username from the store
        username() {
            return this.$store.state.user.name;
        },
        // Check if the user is an admin
        isAdmin() {
            return this.$store.state.user.is_admin;
        }
    },
    methods: {
        // Navigate to the ViewRecords page
        viewRecords() {
            this.$router.push({name: 'ViewRecords'});
        },
        // Unsubscribe the user
        unsubscribe() {
            this.$store.commit('toggleLoading');
            api.unsubscribe()
                .then(response => {
                    localStorage.removeItem('access_token'); // Remove the access token from local storage
                    localStorage.removeItem('user'); // Remove the user from local storage
                    this.$store.commit('setUser', null); // Remove the user from the store
                    this.$router.push({name: 'Home'}); // Navigate to the Home page
                    toast(response.data.message, 'success'); // Show a success toast
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        },
        // Logout the user
        logout() {
            this.$store.commit('toggleLoading');
            api.logout()
                .then(() => {
                    localStorage.removeItem('access_token'); // Remove the access token from local storage
                    localStorage.removeItem('user'); // Remove the user from local storage
                    this.$store.commit('setUser', null); // Remove the user from the store
                    this.$router.push({name: 'Home'}); // Navigate to the Home page
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        }
    }
}
</script>
