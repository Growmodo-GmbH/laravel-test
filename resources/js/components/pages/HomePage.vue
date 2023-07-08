<template>
    <div class="hp-wrapper">
        <div class="form-container">
            <login-form v-if="showLoginForm" @login="handleLogin"></login-form>
            <register-form v-else @register="handleRegister"></register-form>
        </div>
        <div class="divider my-3">
            <hr>
            <span>OR</span>
        </div>
        <div class="toggle-button">
            <span @click="toggleForm">{{ showLoginForm ? 'Register' : 'Login' }}</span>
        </div>
    </div>
</template>

<script>
// Import components and utilities
import LoginForm from '../forms/LoginForm.vue';
import RegisterForm from '../forms/RegisterForm.vue';
import {api, toast} from '../../../utils';

export default {
    components: {
        LoginForm,
        RegisterForm
    },
    data() {
        return {
            showLoginForm: true,
        }
    },
    methods: {
        // Method to toggle between login and register form
        toggleForm() {
            this.showLoginForm = !this.showLoginForm;
        },
        // Method to handle login
        handleLogin(data) {
            this.$store.commit('toggleLoading');
            api.login(data)
                .then(response => {
                    localStorage.setItem('access_token', response.data.access_token);

                    this.$store.commit('setUser', response.data.user);
                    this.$router.push({name: 'Welcome'});
                })
                .catch(error => {
                    if (error.response && error.response.status === 401) {
                        toast(error.response.data.message, 'error');
                    } else if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        Object.values(errors).flat().forEach(errorMessage => {
                            toast(errorMessage, 'error');
                        });
                    }
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        },
        // Method to handle register
        handleRegister(data) {
            this.$store.commit('toggleLoading');
            api.register(data)
                .then(response => {
                    localStorage.setItem('access_token', response.data.access_token);

                    this.$store.commit('setUser', response.data.user);
                    this.$router.push({name: 'Welcome'});
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        Object.values(errors).flat().forEach(errorMessage => {
                            toast(errorMessage, 'error');
                        });
                    }
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        }
    }
}
</script>
